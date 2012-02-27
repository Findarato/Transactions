<?
/************************************************************************************
*Started on November *, 2006														
Used to enable AJAX support on any page int the project as well as dea with 
Specific global pages and functions.  Functions as a global hub of information 
That all pages will include_once. Most of the information listed is very out of date.
8.20.08 Continued to work on mobile edition
5.5.10 Mobile version removed from default setup.  May be added back after normal version is complete
************************************************************************************/


session_start();
$response = array("message"=>"","error"=>"");
$title = 'Transactions 4.0';
function __autoload($class_name) {require_once $_SERVER["DOCUMENT_ROOT"]."/classes/".strtolower($class_name) . '.class.php';}
$db = db::getInstance();
if(isset($_SESSION['user'])) { $userinfo = unserialize($_SESSION['user']);} else { $userinfo = false;}
?>