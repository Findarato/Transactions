<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sun, 8 Aug ".date("Y")." 01:52:00 EST"); // Date in the past best day ever!

include ($_SERVER['DOCUMENT_ROOT']."/graph/src/jpgraph.php");
include ($_SERVER['DOCUMENT_ROOT']."/graph/src/jpgraph_bar.php");
function __autoload($class_name) {  require_once "../classes/".$class_name . '.class.php';}
session_start();

$db = db::getInstance();
$usr = unserialize($_SESSION['user']);
$graph = new Graph(560,200,"auto");	
$graph->SetScale("textlin");
$graph->SetFrame(true,'#f0efea');
$graph->SetMargin(25,5,5,5);
$graph->SetMarginColor('#f0efea');
$graph->title->Set('Spent per Month sum');
$graph->title->SetColor('darkred');
$graph->SetColor('#f0efea'); 

// Setup font for axis
$graph->xaxis->SetFont(FF_FONT1);
$graph->yaxis->SetFont(FF_FONT1);

//$months = array(1=>"Jan",2=>"Feb",3=>"Mar",4=>"Apr",5=>"May",6=>"Jun",7=>"Jul",8=>"Aug",9=>"Sep",10=>"Oct",11=>"Nov",12=>"Dec");
	$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	$sdt1 = date("Y-m-d h:m:s",mktime(0,0,0,date("n")+1,1,date("Y")-1));
	$edt1 = date("Y-m-d h:m:s",mktime(0,0,0,12,31,date("Y")-1));
	$sdt2 = date("Y-m-d h:m:s",mktime(0,0,0,1,1,date("Y")));
	$edt2 = date("Y-m-d h:m:s",mktime(0,0,0,date("n"),date("t"),date("Y")));

	$sql = "
	SELECT MONTH( date ) , 
	TRUNCATE( SUM( distance ) , 2 ) 
	FROM fin_fuel_ledger
	WHERE user_id =".$usr->User_id."
	AND (date
	BETWEEN '$sdt1' AND '$edt1'
	OR date
	BETWEEN '$sdt2' AND '$edt2'
	) AND user_acct=".$usr->Account_main."
	GROUP BY MONTH( date ) 
	";
	

	$res = $db->Query($sql);
	$mpm = array_fill(0, 12, '');
	$line = $db->Format("row_array");
	foreach($line as $l){
		$mpm[$l[0]-1] = $l[1];	
	}
	$monthSlice = array_slice($months,0,date("n"));
	$valueSlice = array_slice($mpm,0,date("n"));

	for($a=0;$a<date("n");$a++){
		array_shift($months);
		array_shift($mpm);
	}
	$months = array_merge($months,$monthSlice);
	$mpm = array_merge($mpm,$valueSlice);


// Create the bar pot
$bplot = new BarPlot($mpm);
$bplot->SetWidth(.9);
$bplot->value-> Show();
// Setup color for gradient fill style 
$bplot->SetFillGradient("lightsteelblue","lightsteelblue",GRAD_HOR);

// Set color for the frame of each bar
$bplot->SetColor("navy");
$bplot->value->SetFormat('%01.2f');
$graph->Add($bplot);
$graph->yaxis->HideZeroLabel();
$graph->yaxis-> scale-> SetGrace(10);
$graph->xaxis->SetTickLabels($months);
$graph->xaxis->SetLabelMargin(0);
$graph->yaxis->SetLabelMargin(0);
// Finally send the graph to the browser
$graph->Stroke();
?>
