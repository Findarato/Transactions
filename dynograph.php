<?php
session_start();
include_once("config.php");
include_once("functions.php");
include ("graph/src/jpgraph.php");
include ("graph/src/jpgraph_bar.php");
include ("graph/src/jpgraph_line.php");

function __autoload($class_name) {
    require_once "classes/".$class_name . '.class.php';
}
if(isset($_SESSION["user"])){//There is an active loged in user
	$user = unserialize($_SESSION["user"]);
	$db = db::getInstance();
}else{ die("Not a Valid User"); }

//Must set values
$graphTitle = "Blank or Not a valid Category";
$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
$parentCate = $_GET['parent'];
$acct = $_GET['acct'];
$dataPlot = array_fill(0, 12, '');
$sdt1 = date("Y-m-d h:m:s",mktime(0,0,0,date("n")+1,1,date("Y")-1));
$edt1 = date("Y-m-d h:m:s",mktime(0,0,0,12,31,date("Y")-1));
$sdt2 = date("Y-m-d h:m:s",mktime(0,0,0,1,1,date("Y")));
$edt2 = date("Y-m-d h:m:s",mktime(0,0,0,date("n"),date("t"),date("Y")));

//End of Must set values

// Setup the graph. 
$graph = new Graph(400,200,"auto");	
$graph->SetScale("textlin");
$graph->img->SetMargin(35,15,25,25);

// Setup font for axis
$graph->xaxis->SetFont(FF_FONT1);
$graph->yaxis->SetFont(FF_FONT1);

//Check to see if there is a goal set for this category
$db->Query("SELECT amount,frequency,name FROM ".$db->Prefix."goals WHERE user_id=".$user->User_id." AND cate_id=".$parentCate);
$goal = $db->Format("assoc");
if(is_array($goal) && $goal['frequency'] == 30){//this is a month goal
//something will happen not sure what yet
}
if(count($goal)!=3){$goalGraph = array_fill(0,13,0);} //There is no goal for this Category
else {$goalGraph = array_fill(0,13,$goal['amount']); $graphTitle = $goal['name'];} //There is a goal for this Category



	if($parentCate=="all"){$graphTitle="Graph of Total Spending By month";
		$sql = "
		";
		$sql2 = "
		SELECT dt AS dt,
		TRUNCATE(  debit  , 2) AS debit,
		TRUNCATE(  credit  , 2) AS credit
		FROM ".$db->Prefix."ledger
		WHERE user_id = ".$user->User_id."
		AND acct_id=".$acct."

		";
		$res2 = $db->Query($sql2);
		$row2 = $db->Format("assoc_array");


		$runningTotal = 0;
		foreach($row2 as $line){
			$runningTotal += ($line['credit']-$line['debit']);
			$rtPlot[] = $runningTotal;
		}
		$rt = new LinePlot($rtPlot);
		$rt -> SetColor("#00CF00");
/*
		$valueSlice = array_slice($rtPlot,0,date("n"));
		for($a=0;$a<date("n");$a++){
		
			array_shift($rtPlot);
		}
		
		$rtPlot = array_merge($rtPlot,$valueSlice);

		$res = $db->Query($sql);
		$row = $db->Format("assoc_array");
	
		if(isset($row) && count($row)>1){//there is something
			foreach($row as $line){
				$dataPlot[$line['dt']-1] = $line['credit']-$line['debit'];
			}
		}

		*/
	}	
	else{
		//Get children
		$childParentId=$db->Query("SELECT id,cate_name FROM ".$db->Prefix."categories WHERE user_id=".$user->User_id." AND (parent=".$parentCate." OR id=".$parentCate.")");
		//echo $db->Lastsql;
		$cpIds = $db->Format("assoc_array");
		if(isset($cpIds) && count($cpIds)>=1){//there is something
			foreach($user->Accounts as $act){ $accIds[]=$act['id'];}
			if(!isset($graphTitle) || $graphTitle == "Blank or Not a valid Category"){ $graphTitle = $cpIds[0]['cate_name']; }//if no title is set, Choose the Parent
			foreach($cpIds as $cpi){ $ids[] = $cpi['id'];	}
			$ids = join(",",$ids);
			$aids = join(",",$accIds);

			$sql = "
			SELECT MONTH( dt ) , 
			TRUNCATE( SUM(debit) , 2) AS debit,
			TRUNCATE( SUM(credit), 2) AS credit
			FROM ".$db->Prefix."ledger
			WHERE user_id = ".$user->User_id."
			AND category in($ids)
			AND acct_id in($aids)
			AND (dt
			BETWEEN '$sdt1' AND '$edt1'
			OR dt
			BETWEEN '$sdt2' AND '$edt2'
			)
			GROUP BY MONTH( dt ) 
			";

	
	
		$res = $db->Query($sql);
		$row = $db->Format("row_array");
	
		if(isset($row) && count($row)>1){//there is something
			foreach($row as $line){
				$dataPlot[$line[0]-1] = abs($line[2]-$line[1]);
			}
		}
	}
	$monthSlice = array_slice($months,0,date("n"));
	$valueSlice = array_slice($dataPlot,0,date("n"));

	for($a=0;$a<date("n");$a++){
		array_shift($months);
		array_shift($dataPlot);
	}
	$months = array_merge($months,$monthSlice);
	$dataPlot = array_merge($dataPlot,$valueSlice);
}
//echo $db->Lastsql;	



//print_r($dataPlot);
$graph->title->Set($graphTitle);
$graph->title->SetColor('darkred');
// Create the bar pot
$goalplot = new LinePlot($goalGraph);
$goalplot -> SetColor("black");
$bplot = new BarPlot($dataPlot);
$bplot->SetWidth(.9);
$bplot->value-> Show();
$bplot->value->SetColor("black","darkred");
$bplot->value->SetFont(FF_ARIAL,FS_NORMAL,8);
$bplot->value->SetAngle(90);
$bplot->SetValuePos('center');
$bplot->value->SetFormat('%01.2f'); 

// Setup color for gradient fill style 

if(count($goal)==3){
foreach($dataPlot as $dp){ //Loop though and make the graph colorful
	$per = ($dp/$goal['amount']);
	switch($per){
		case ($per<=1) && ($per > .75):
			$color[] = $user->Config['progfill2'];
		break;
		case ($per>1) :
			$color[] = $user->Config['progfill3'];
		break;
		default:
			$color[] = $user->Config['progfill'];
		break;
	}
}
}else { $color = array_fill(0, 12, $user->Config['progfill']);} //no goal set just use the green color
$bplot->SetFillColor($color,"black",GRAD_HOR);
// Set color for the frame of each bar
$bplot->SetColor('black');
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->yaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
if($parentCate=="all"){$graph->Add($rt);}else{$graph->Add($bplot); $graph->Add($goalplot);}
$graph->yaxis->HideZeroLabel();
$graph->yaxis-> scale-> SetGrace(10);
$graph->xaxis->SetTickLabels($months);
$graph->Stroke();
?>