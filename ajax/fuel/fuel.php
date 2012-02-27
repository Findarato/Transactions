<?
//Add in the fuel GETing.
//This will assume that no other fuel entry in the last 5 fuel entries has the same amount paid.
if(!isset($_SESSION)){
	session_start();
}
include("../../classes/db.class.php");
include("../../classes/user.class.php");
$db = db::getInstance();
$user = unserialize($_SESSION['user']);

//lets first get the last fuel entry updated with the miles
$sql = "SELECT id FROM ".$db->Prefix."fuel WHERE user_id=".$user -> User_id." AND distance=0";
$db -> Query($sql);
$id = $db -> format("row");//Assign $id to be last updated one for this user

//Update the record

$db -> Query("UPDATE ".$db->Prefix."fuel SET distance =".$_GET['miles']."WHERE id=$id");
//Now we add the data in. 
//Find the correct fuel entry.
$fuelcate = $user -> Config['fuel_cate_id'];

$db -> Query("SELECT id FROM ".$db -> Prefix."ledger WHERE category = $fuelcate AND debit = ".$_GET['paid']." ORDER BY dt DESC LIMIT  1" );
$ledgid = $db -> format("row");
//echo $db->Lastsql;

$sql = "INSERT INTO fin_fuel (
ledger_id,user_id,debit,price_per,amount,type) 
VALUES (
".$ledgid.",".$user -> User_id.",".$_GET["paid"].",".$_GET["price"].",".$_GET["amount"].",'".$_GET["type"]."')";
$db -> Query($sql);
//echo $db->Lastsql;
//to be used later
//ALTER TABLE `config` ADD `fuelcate` INT NOT NULL COMMENT 'Category of Fuel';
//ALTER TABLE `config` ADD INDEX ( `fuelcate` ) ;

?>

 