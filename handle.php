<?
/*
//This is the handle script.  It will handle all of the 
//Transaction that are posted to the section.
//It is very simple, takes input and adds it to the database.
//Started on October, 18, 2002.
//Also handles the login for users
This is by far the oldest part of the site.  As of January 2009 it still lives.
projected to die soon thought.
*/

//require("database.inc");
require_once("config.php");
if(!isset($_SESSION)){session_start();}
function __autoload($class_name) { require_once "classes/".$class_name . '.class.php';}

$db = db::getInstance();
//echo "$_POST[catagory],$_POST[other],$_POST[note],$_POST[credit],$_POST[debit]";
$broken = 0;
if(isset($_POST["debit"]) or isset($_POST["credit"])) {
	$now=date("Y-m-d");
	if ( !isset($_POST["debit"]) )
		$_POST["debit"] = 0;

	if ( !isset($_POST["credit"]) )
		$_POST["credit"] = 0;

	$sql = "INSERT INTO $tledger 
	values('','$_POST[credit]','$_POST[debit]',NOW(),'$_POST[subCategory]','$_POST[note]','$_SESSION[dktn]','1','$_POST[ckno]')";
	$result = mysql_query($sql);

	echo "<center>Entered Correctly</center>";
	    echo "<SCRIPT LANGUAGE='JavaScript'>";
		echo "function loadme(){";
		echo "parent.bottom.location.href='blank.php' }";
		echo "</script>";		
		echo "<body onLoad=loadme()>";

	$broken = 1;
}

//Code that handles login information and sets the correct session variables
if (isset($_POST["login"])) {
	$user = new user($_POST['login'],$_POST['pass']);
	echo "Processing Login";
	//echo "<pre>";print_r($user);echo "</pre>";
	if($user -> Username == "Guest") {
		echo "Invalid User";
		echo "<a href='/transaction/'> Try again</a>";
	} else {
		$userid = $valid["id"];
		$_SESSION['user'] = serialize($user);

	    echo "<SCRIPT LANGUAGE='JavaScript'>";
		echo "function loadme(){";
		echo "parent.location.href='/' }";
		echo "</script>";		
		echo "<body onLoad=loadme()>";

	}
}

	$broken = 1;

if($broken==0)
	echo "broken";
?>