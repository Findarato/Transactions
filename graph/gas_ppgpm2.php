<?php
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sun, 8 Aug ".date("Y")." 01:52:00 EST"); // Date in the past best day ever!

include ("../graph/src/jpgraph.php");
include ("../graph/src/jpgraph_line.php");
function __autoload($class_name) {  require_once "../classes/".$class_name . '.class.php';}
session_start();
$db = db::getInstance();
if(isset($_SESSION['user']) ){ 
	$userinfo = unserialize($_SESSION['user']);
//Figure out the values
	$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	$sdt1 = date("Y-m-d h:m:s",mktime(0,0,0,date("n")+1,1,date("Y")-1));
	$edt1 = date("Y-m-d h:m:s",mktime(0,0,0,12,31,date("Y")-1));
	$sdt2 = date("Y-m-d h:m:s",mktime(0,0,0,1,1,date("Y")));
	$edt2 = date("Y-m-d h:m:s",mktime(0,0,0,date("n"),date("t"),date("Y")));
	$sql = "
	SELECT MONTH( date ) , 
	TRUNCATE( MIN( price_per ) , 3 ),
	TRUNCATE( AVG( price_per ) , 3 ),
	TRUNCATE( MAX( price_per ) , 3 ) 
	FROM fin_fuel_ledger
	WHERE user_id =".$userinfo -> User_id."
	AND (date
	BETWEEN '$sdt1' AND '$edt1'
	OR date
	BETWEEN '$sdt2' AND '$edt2'
	)
	GROUP BY MONTH( date ) 
	";
	
	$res = $db->Query($sql);
	$dataMin = array();
	$dataMin = array_fill(0, 12,0);
	$dataMax = array();
	$dataMax = array_fill(0, 12,0);
	$dataAvg = array();
	$dataAvg = array_fill(0, 12,0);	
	$line = $db->Format("row_array");
	foreach($line as $l){
		$dataAvg[$l[0]-1] = abs($l[2]);
		$dataMax[$l[0]-1] = abs($l[3]);
		$dataMin[$l[0]-1] = abs($l[1]);
	}

	$monthSlice = array_slice($months,0,date("n"));
	$valueSlice1 = array_slice($dataMax,0,date("n"));
	$valueSlice2 = array_slice($dataAvg,0,date("n"));
	$valueSlice3 = array_slice($dataMin,0,date("n"));
	
	for($a=0;$a<date("n");$a++){
		array_shift($months);
		array_shift($dataMax);
		array_shift($dataAvg);
		array_shift($dataMin);		
	}
	
	$months = array_merge($months,$monthSlice);
	$dataMax = array_merge($dataMax,$valueSlice1);
	$dataAvg = array_merge($dataAvg,$valueSlice2);
	$dataMin = array_merge($dataMin,$valueSlice3);
// Setup the graph. 
// Setup the graph. 
$graph = new Graph(560,200,"auto");	
$graph->SetScale("textlin");
$graph->img->SetMargin(35,15,25,25);

$graph->title->Set('Price per Gallon');
$graph->title->SetColor('darkred');

$lineplot2 =new LinePlot($dataMax);
$lineplot2 ->SetColor("orange");
$lineplot2 ->SetWeight(2);
$lineplot2->value-> Show();
$lineplot2 ->value->SetFormat( "$ %0.1f");
$graph->Add( $lineplot2);

$lineplot3 =new LinePlot($dataMin);
$lineplot3 ->SetColor("red");
$lineplot3 ->SetWeight(2);
$lineplot3->value-> Show();
$lineplot3 ->value->SetFormat( "$ %0.1f");
$graph->Add( $lineplot3);

$graph->yaxis->HideZeroLabel();
$graph->yaxis-> scale-> SetGrace(10);
$graph->xaxis->SetTickLabels($months);
// Set the legends for the plots
$lineplot3->SetLegend("Min");
$lineplot2->SetLegend("Max");

// Adjust the legend position
$graph->legend->SetLayout(LEGEND_HOR);
$graph->legend->Pos(0.1,0.00,"left","top");

// Finally send the graph to the browser
$graph->Stroke();
}
?>