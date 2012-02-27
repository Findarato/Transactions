<?
/********************************************************************
* Started Unknown constantly modified								*
* Used to set paramaters that all scripts can use as well as global	*
* Database values along with table definitions.  The values in here	*
* Will eventually be stored in the Table named $prefix.conifg		*
* Only values to be globally stored will be the database connetivity*
* Information.  Also hoping to store many of the stylesheet values	*
* in a table, but that is still to be determined.					*
********************************************************************/
 
/*Database Connectivity Information*/
global $docRoot;
global $dbase;
global $user;
global $password;
global $host;
$prefix			= 	"fin_";
$dbase			= 	"joe";
$user 			= 	"jharry";
$password		= 	"jh82drys";
$path 			= 	"/";
$docRoot		= 	"/home/jharry/public_html";
$tusers 		= 	$prefix."users";
$host			= 	"localhost";

//Get the information from the config tables

/*Table Definitions*/

$taccounts	 		= 	$prefix	."accounts";
$tledger			= 	$prefix	."ledger";
$tcata 				= 	$prefix	."categories"; 
$tloans 			= 	$prefix	."loans"; 
$tgoals 			= 	$prefix	."goals"; 


/*Add on configurations*/

/*Progress bar color scheme*/
/*
$progbgc	 		= 	$cfg['progbgc'];
$progfill 			= 	$cfg['progfill'];
$progframe			=	$cfg['progframe'];
$progimgtype		=	$cfg['imgtype']; //Not working 
*/
/*Graph color scheme*/


?>
