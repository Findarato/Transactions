<?php
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sun, 8 Aug 2008 01:52:00 EST"); // Date in the past best day ever!
	function __autoload($class_name) { require_once "../classes/".$class_name . '.class.php';}
	include '../classes/ofc-library2/open-flash-chart.php';
	include_once '../functions.php';

session_start();
$db = db::getInstance();
$colors = array(
	'#C0C0C0',
	'#FFA500',
	'#6D86CC',
	'#9B30FF',
	'#7CFC00',
	'#000000',
	'#EEB422',
	'#B22222',
	'#4876FF'
);

if(isset($_SESSION['user']) ){ 
	$parts = array();//predefine to assure no notices
	$usr = unserialize($_SESSION['user']);
	$db->Query("SELECT id,cate_name FROM ".$db->Prefix."categories WHERE cate_type='debit' AND user_id=".$usr->User_id." AND parent=0;");
	//echo $db->Lastsql;
	$res = $db->Format("assoc_array");
	foreach($res as $r){
		$value = GetTotal($r['id'],date("Y/m").'/1',date("Y/m/t"),$usr->Accounts[0]['id']);
		if($value>0){$parts[] = new pie_value($value,$r['cate_name']);}
	}
	$pie = new pie();
	$pie->set_colours($colors);
	$pie->set_start_angle( 35 );
	$pie->set_animate( true );
	$pie->set_tooltip( '#val# of #total#<br>' );
	//$pie->set_values( array(2,3,6.5) );
	$pie->set_values($parts);
	//$pie->set_gradient_fill();
	$chart = new open_flash_chart();
	//$chart->set_title( $title );
	$chart->add_element( $pie );
	$chart->set_bg_colour( '#FFFFFF' );
	$chart->x_axis = null;
	echo $chart->toPrettyString();
}
?>