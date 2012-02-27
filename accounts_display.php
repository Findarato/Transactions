<? //Smarty redesign of the site.  Started August 2, 2007
//This will generate the account list and the totals.
if(isset($_SESSION['user'])){
//There is an active loged in user
$userinfo -> Loadaccounts();
$account = array();
//print_r($userinfo->Accounts);
foreach($userinfo -> Accounts as $accts){
	$balance = round($accts["credit"] - $accts["debit"],2);
	if($balance<0){$balance = "(".abs($balance).")";}
	$account[] = array("id" => $accts["id"],"name" => $accts["acct_name"],"type" => $accts["acct_type"],"balance" => $balance);
}
	$smarty->assign('accinfo',$account);
}
?>