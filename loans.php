<?
	/*------------------------------------------------------------------------------**
	**						Started November 2, 2006 (Nov 30 2007)  				**
	**This will allow for loan display and editing.  The account assigned to the	**
	**loan are the categorys that will determin the payments or charges on the loan	**
	**Intrest will be calculated on a bases determined each time the loan payment	**
	**Is paid, and the value goes down.  If the value ever goes up the intrest will	**
	**Not be calculated till the next negative payment to the account.				**	
	**------------------------------------------------------------------------------*/
include_once "header.php";
$smarty->display("body.tpl");
?>