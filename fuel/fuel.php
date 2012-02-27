<?
//Add in the fuel posting.
//This will assume that no other fuel entry in the last 5 fuel entries has the same amount paid.
if(!isset($_SESSION)){
	session_start();
}
$db = db::getInstance();
$user = unserialize($_SESSION['user']);

//lets first get the last fuel entry updated with the miles
$sql = "SELECT id FROM ".$db->Prefix."fuel WHERE user_id=".$user -> User_id." AND distance=0";
$db -> query($sql);
list($id) = $db -> format("row");//Assign $id to be last updated one for this user
//Update the record
$db -> query("UPDATE ".$db->Prefix."fuel SET distance =".$_POST['miles']."WHERE id=$id");
//Now we add the data in. 
//Find the correct fuel entry.
$fuelcate = $user -> Config['fuel_cate_id'];

$db -> query("SELECT id FROM ".$db -> Prefix."ledger WHERE category = $fuelcate AND debit = ".$_POST['paid']." ORDER BY dt DESC LIMIT  1" );
list($ledgid) = $db -> format("row");
//echo $db->Lastsql;

$sql = "INSERT INTO fin_fuel (
ledger_id,user_id,debit,price_per,amount,type) 
VALUES (
".$ledgid.",".$user -> User_id.",".$_POST["paid"].",".$_POST["price"].",".$_POST["amount"].",'".$_POST["type"]."')";
$db -> query($sql);
echo $db->Lastsql;
//to be used later
//ALTER TABLE `config` ADD `fuelcate` INT NOT NULL COMMENT 'Category of Fuel';
//ALTER TABLE `config` ADD INDEX ( `fuelcate` ) ;

?>

 