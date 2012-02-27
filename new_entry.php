<? //This will generate the nessary values for the quick add side object.
	//Create the array variables

	$childCate = array();
	$mainCate = array();
	$in = array();
	$db = db::getInstance();
	$sql = "SELECT id,cate_name,icon FROM ".$db -> Prefix."categories WHERE user_id=".$userinfo -> User_id." AND parent='0' ORDER BY cate_name";
	$db -> Query($sql);
	$line = $db -> Format("assoc_array");
	foreach ($line as $l){
		$mainCate[$l["id"]]=$l["cate_name"];
		$in[]=$l["id"];
	}

	if(!is_array($in))
		$in[0] = 0; //makes sure there is a value in the array
		
	$sql = "SELECT id,cate_name,icon,parent FROM ".$db -> Prefix."categories WHERE parent in(".join(",",$in).") ";
	$db -> Query($sql);
	$res = $db -> Format("assoc_array");
		//or die($sql);
	foreach($res as $child){//build the array
		$childCate[$child["parent"]][]=array("id"=>$child["id"],"name"=> $child["cate_name"],"icon"=>$child["icon"]);
	}
	foreach($userinfo->Accounts as $ua){ $accnt[$ua['id']] = $ua['acct_name']; } //format the user accounts to work with the display
	
	$smarty->assign('accnt',$accnt);
	$smarty->assign('mainCate',$mainCate);
	$smarty->assign('childCate',$childCate);
	$smarty->assign('dc',array("d"=>"Debit","c"=>"Credit"));

?>