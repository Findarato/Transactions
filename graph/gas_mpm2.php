<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sun, 8 Aug ".date("Y")." 01:52:00 EST"); // Date in the past best day ever!

//Pchart
include($_SERVER['DOCUMENT_ROOT']."/pChart/pChart/pData.class");
include($_SERVER['DOCUMENT_ROOT']."/pChart/pChart/pChart.class");

function __autoload($class_name) {  require_once "../classes/".$class_name . '.class.php';}
session_start();
$user=$_SESSION['user'];
$db = db::getInstance();
// Setup the graph. 


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
	WHERE user_id =1
	AND (date
	BETWEEN '$sdt1' AND '$edt1'
	OR date
	BETWEEN '$sdt2' AND '$edt2'
	)
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

  // Dataset definition 
  $DataSet = new pData;
  $DataSet->AddPoint($mpm,"Serie1");
  $DataSet->AddPoint($months,"Serie3");
  $DataSet->AddAllSeries();
  $DataSet->RemoveSerie("Serie3");  
  $DataSet->SetAbsciseLabelSerie("Serie3"); 
//  $DataSet->SetSerieName("January","Serie1");

  // Initialise the graph
  $Test = new pChart(560,200);

$Test->setFontProperties($_SERVER['DOCUMENT_ROOT']."/pChart/Fonts/tahoma.ttf",8);
  $Test->setGraphArea(50,30,540,160);
  $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
  //$Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
  $Test->drawGraphArea(255,255,255,TRUE);
  $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);   
  $Test->drawGrid(4,TRUE,230,230,230,50);

//$Test->writeValues($mpm,$mpm,"Serie1");
  // Draw the 0 line
  $Test->setFontProperties($_SERVER['DOCUMENT_ROOT']."/pChart/Fonts/tahoma.ttf",6);
  $Test->drawTreshold(0,143,55,72,TRUE,TRUE);
  $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","May","1002.11",255,255,255);  
    $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","Apr","1002.11",255,255,255);  
	  $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","Aug","1002.11",255,255,255);  
	  	  $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","Jun","1002.11",255,255,255);  
		  	  $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","Jul","1002.11",255,255,255);  
  // Draw the bar graph
  $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);

  // Finish the graph
  $Test->setFontProperties($_SERVER['DOCUMENT_ROOT']."/pChart/Fonts/tahoma.ttf",8);
  $Test->drawLegend(596,150,$DataSet->GetDataDescription(),255,255,255);
  $Test->setFontProperties($_SERVER['DOCUMENT_ROOT']."/pChart/Fonts/tahoma.ttf",10);
  $Test->drawTitle(50,22,"Miles Per Month",50,50,50,585);
//  $Test->Render("example12.png");
  $Test->Stroke();
 

?>
