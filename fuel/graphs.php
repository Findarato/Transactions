<?
include_once "../header.php";
include_once "../functions.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/classes/ofc-library/open_flash_chart_object.php';
//include_once $_SERVER['DOCUMENT_ROOT'].'/classes/php5-ofc-library/open-flash-chart-object.php.php';
$graph = array();
$graph[] = open_flash_chart_object_str( 500, 300, 'http://'. $_SERVER['SERVER_NAME'] .'/flashgraph/gas_mpgpm.php', false,"/");
$graph[] = open_flash_chart_object_str( 500, 300, 'http://'. $_SERVER['SERVER_NAME'] .'/flashgraph/gas_mpm.php', false,"/");
$graph[] = open_flash_chart_object_str( 500, 300, 'http://'. $_SERVER['SERVER_NAME'] .'/flashgraph/gas_ppgpm.php', false,"/");
$graph[] = open_flash_chart_object_str( 500, 300, 'http://'. $_SERVER['SERVER_NAME'] .'/flashgraph/gas_ppgpm2.php', false,"/");
$graph[] = open_flash_chart_object_str( 500, 300, 'http://'. $_SERVER['SERVER_NAME'] .'/flashgraph/gas_spentpm.php', false,"/");
$smarty->assign('graphs',$graph);
$smarty->assign('content','fuel/graphs.tpl');
$smarty->display("body.tpl");

?>
