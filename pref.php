<?
include_once "header.php";
//$smarty->assign('content','category_display.tpl');
$db = db::getInstance();
$smarty->assign('pref',$userinfo->Config);
$smarty->assign('pref',$userinfo->Config);
$smarty->assign('content','preferences.tpl');
$smarty->display("body.tpl");
?>