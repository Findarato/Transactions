<?php
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sun, 8 Aug ".date("Y")." 01:52:00 EST"); // Date in the past best day ever!

include ("../graph/src/jpgraph.php");
include ("../graph/src/jpgraph_bar.php");
function __autoload($class_name) {  require_once "../classes/".$class_name . '.class.php';}
session_start();
$db = db::getInstance();
$usr = unserialize($_SESSION['user']);


// Setup the graph. 
$graph = new Graph(175,100,"auto");	
$graph->SetFrame(false);
$graph->SetScale("textlin");
$graph->SetMargin(0,0,0,0);
$graph->SetMarginColor('#f0efea');
//$graph->title->Set('Miles per Gallon avg');
$graph->SetColor('#f0efea'); 
$graph->title->SetColor('darkred');

// Setup font for axis
$graph->xaxis->SetFont(FF_FONT1);
$graph->yaxis->SetFont(FF_FONT1);

	$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	$sdt1 = date("Y-m-d h:m:s",mktime(0,0,0,date("n")+1,1,date("Y")-1));
	$edt1 = date("Y-m-d h:m:s",mktime(0,0,0,12,31,date("Y")-1));
	$sdt2 = date("Y-m-d h:m:s",mktime(0,0,0,1,1,date("Y")));
	$edt2 = date("Y-m-d h:m:s",mktime(0,0,0,date("n"),date("t"),date("Y")));

	$sql = "
	SELECT MONTH( dt ) , 
	TRUNCATE( SUM( credit ) - SUM( debit ) , 2 ) 
	FROM fin_ledger
	WHERE user_id =".$usr->User_id."
	AND (dt
	BETWEEN '$sdt1' AND '$edt1'
	OR dt
	BETWEEN '$sdt2' AND '$edt2'
	) AND acct_id=".$usr->Account_main."
	GROUP BY MONTH( dt ) 
	";
	$db -> query($sql);
	$res = $db -> format("row_array");
	$data = array_fill(0, 12, '');
	foreach($res as $line){
		$data[$line[0]-1] = $line[1];	
	}

	$monthSlice = array_slice($months,0,date("n"));
	$valueSlice = array_slice($data,0,date("n"));

	for($a=0;$a<date("n");$a++){
		array_shift($months);
		array_shift($data);
	}
	$months = array_slice(array_merge($months,$monthSlice),6,6);
	$data = array_slice(array_merge($data,$valueSlice),6,6);
	//$data=array(100,100,100,100,100,100);

// Create the bar pot
$bplot = new BarPlot($data);
$bplot->SetWidth(.9);
//$bplot->value-> Show();
// Setup color for gradient fill style 
$bplot->SetFillGradient("lightsteelblue","lightsteelblue",GRAD_VER);

// Set color for the frame of each bar
$bplot->SetColor("navy");
$bplot->value->SetFormat('%01.2f');
$graph->Add($bplot);
$graph->yaxis->HideZeroLabel();
$graph->xaxis->SetColor("black","black");
//$graph->xaxis->SetLabelSide (SIDE_UP);
$graph->xaxis->SetTickLabels($months);
$graph->xaxis->SetLabelMargin(0);

// Finally send the graph to the browser
$graph->Stroke();
?>