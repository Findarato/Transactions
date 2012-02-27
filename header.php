<?
/************************************************************************************
*Started on November *, 2006														
Used to enable AJAX support on any page int the project as well as dea with 
Specific global pages and functions.  Functions as a global hub of information 
That all pages will include_once. Most of the information listed is very out of date.
8.20.08 Continued to work on mobile edition
5.5.10 Mobile version removed from default setup.  May be added back after normal version is complete
************************************************************************************/

include("small_header.php");
$tim1 = array_sum(explode(' ',microtime()));
define('SMARTY_DIR', '/data/vhost/findarato.org/Smarty/libs/');
function getUrl() {
	//Gets and formats the URI and returns the correct array
	$turi = strtolower(str_replace("%20"," ",$_SERVER["REQUEST_URI"]));
	$data = split("/",$turi);
	$data = array_slice($data,1,count($data)-1);
	return $data;
}
function getFileUrl(){
	$turi = strtolower(str_replace("%20","_",$_SERVER["REQUEST_URI"]));
	$data = split("/",$turi);
	$data = array_slice($data,1,count($data)-1);
	return $data;
}

require_once(SMARTY_DIR . 'Smarty.class.php');
$docRoot = "/data/vhost/findarato.org/transactions";
//Create a new smarty object and set nessary values
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->template_dir = $docRoot.'/templates/';
$smarty->compile_dir  = $docRoot. '/templates_c/';
$smarty->config_dir   = $docRoot.'/configs/';
$smarty->cache_dir    = $docRoot.'/cache/';



//$smarty->assign("path",$path);
if(isset($_SESSION['user'])) { //set some global values for the user	
	$userinfo = unserialize($_SESSION['user']);
	$smarty->assign('firstName',$userinfo -> Username);
} else { //put something in so its not just "Welcome"
	$smarty->assign('firstName',"Anonymous");
}

//Setup the calendar
$smarty->assign('title',$title);
$uri = getFileUrl();
if(isset($_SESSION['user']) ){ 
//Done to help rendering speed.
	$loggedin = true;
	if(strlen($uri[0])==0 || strlen($uri[0])==4){ //This is the very basic page.
		$smarty->assign('location','home');
		include_once "reacent_transactions.php";
		$smarty->assign("count","15");
	}else { //not the start page
		$page = 'blank.tpl'; //blank
		$smarty->assign('content',$page); //This is a blank filler template
	}
}else{ //the user is not loged in
	$smarty->assign('content','login.tpl');
	$loggedin = false;
}
unset($uri);
//Global includes
if($loggedin){
//	include_once "ajax/quick_goals.php";
	include_once "accounts_display.php";
	include_once "ajax/quick_add.php";
	include_once "reminder.php";
}
$tim2 = array_sum(explode(' ',microtime())); 

$total_time = $tim2 - $tim1;
$total_time = sprintf('%6f', $total_time); 
$totalexetime = 'Total execution time: ' . $total_time . ' sec'; 
$smarty->assign('totalexectime',$totalexetime);
$smarty -> assign('totalsql',$db->Queries);
?>