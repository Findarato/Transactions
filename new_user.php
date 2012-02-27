<?
$db = db::getInstance();
$db->Query("INSERT INTO ".$db->Prefix."accounts (user_id,acct_name,acct_type,cate_id,interest,main) VALUES (".$userId.",'My Checking','Checking',0,0,1)");
$acctId = $db->Lastid;
///Create the payment Categories
$db->Query("INSERT INTO ".$db->Prefix."categories (user_id,cate_name,cate_type,parent) VALUES (".$userId.",'Payments','Debit',0)");
$parent = $db->Lastid;
$db->Query("INSERT INTO ".$db->Prefix."categories (user_id,cate_name,cate_type,parent) VALUES (".$userId.",'Payment','Debit',".$parent.")");
//Create the Misc categories
$db->Query("INSERT INTO ".$db->Prefix."categories (user_id,cate_name,cate_type,parent) VALUES (".$userId.",'Misc.','Debit',0)");
$parent = $db->Lastid;
$db->Query("INSERT INTO ".$db->Prefix."categories (user_id,cate_name,cate_type,parent) VALUES (".$userId.",'Correct to Bank','Debit',".$parent.")");
$db->Query("INSERT INTO ".$db->Prefix."categories (user_id,cate_name,cate_type,parent) VALUES (".$userId.",'Starting Value','Debit',".$parent.")");
$svcId = $db->Lastid;
$db->Query("INSERT INTO ".$db->Prefix."ledger (credit,category,note,user_id,acct_id) VALUES ($startValue,".$svcId.",'Starting Value',".$userId.",".$acctId.")");
$db->Query("INSERT INTO ".$db->Prefix."categories (user_id,cate_name,cate_type,parent) VALUES (".$userId.",'Carry Over Value','Debit',".$parent.")");

?>