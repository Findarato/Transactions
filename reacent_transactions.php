<? //This will get all the reacent transcations for all accounts

$sql = "
SELECT 		l.id,
			l.credit,
			l.debit,
			l.dt,
			c.cate_name,
			l.note,
			l.ckno,
			l.acct_id
FROM		fin_ledger
AS			l
JOIN		fin_categories
AS			c
ON			(c.id=l.category)
WHERE		l.user_id = ".$userinfo -> User_id."
ORDER BY 	l.dt DESC";

$tans = array();
$db = db::getInstance();
$db -> query($sql);
$res = $db -> format("row_array");
foreach($res as $row){
	$trans[] = array(
	'acct_id'=>$row[7],
	'id'=>$row[0],
	'credit'=>$row[1],
	'debit'=>$row[2],
	'category'=>$row[4],
	'date'=>date($userinfo -> Config['date_format'],strtotime($row[3])),
	'note'=>$row[5],
	'ckno'=>$row[6]);
}
$smarty->assign("trans",$trans);
?>