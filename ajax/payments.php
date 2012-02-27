<?
/************************************************************
Started January 30, 2009
The new payments,  The whole page will be ajax.  Going to send over
the data in xml format and then fill it in.
************************************************************/
session_start();
//function __autoload($class_name) {require_once "../classes/".strtolower($class_name) . '.class.php';}
require_once ("../classes/db.class.php");
require_once ("../classes/user.class.php");
$db = db::getInstance();
if(isset($_SESSION["user"])){//There is an active loged in user
	$usr = unserialize($_SESSION["user"]);}else{die("No data for you!");}
	$usr->Loadaccounts();
	//Get and Display current accounts

	$acctCate = $usr->Accounts;
	$totals = 0; //holder 
	//posted data is a new payment, or a payment
	if(count($_POST)>0){ //there has been a post
		if(isset($_POST['cate_id']) && isset($_POST['ammount']) ){
			//lets find the right info
			//Array ( [ammount] => 100 [acct_id] => 8 [cate_id] => 98 [button] => Post ) 
			if($usr->Checkaccounts($_POST['id'])){ //do a paranoid check of the accounts
				//Start with the debit, then credit
				$usr->Add("d",abs($_POST['ammount']),$_POST['cate_id'],"NOW()",$usr->Account_main,'Payment');
				$usr->Add("c",abs($_POST['ammount']),$usr->Payment_id,"NOW()",$_POST['id'],'Payment');
			} else { echo "invalid account ID, please relog, or stop trying to hack it!"; }
		}else{echo "Something is wrong with the post";}
	} 
	//print_r($acctCate); die();
	if(isset($_GET['format'])){//The user has passed the right info
		switch ($_GET['format']){
		 	case "xml":
				header("Content-type: text/xml"); 
				header("Cache-Control: no-cache"); 
				echo "<?xml version=\"1.0\"?>"; 
				//This is the xml you want to see
				echo "<t>";
				echo "<rows>"; 
				foreach($acctCate as $res){		
					//Calculate a running total
					$val = ($res['credit']-$res['debit']);
					$totals+=$val;
					if($val<0){$val="(".abs($val).")";}
						echo "<row>";
							echo "<icon>"."<![CDATA[<img src=\"images/Icons/money.png\" alt=\"".$res['id']."\" class=\"smallimg\">]]></icon>";
							echo "<name>".$res['acct_name']."</name>";
							echo "<type>".$res['acct_type']."</type>";
							echo "<interest>".$res['interest']."</interest>";
							echo "<cate_id>".$res['cate_id']."</cate_id>";
							echo "<cate_name>".$res['cate_name']."</cate_name>";
							echo "<balance>".$val."</balance>";	
							echo "<id>".$res['id']."</id>";	
						echo "</row>";
				}
				echo "</rows>";
				if($totals<0){$totals="(".abs($totals).")";}
				echo "<total>".$totals."</total>";
				echo "<queries>".$db->Queries."</queries>";
				echo "</t>";
			break;
			case "json":
				//header('Content-type: application/json');
				$json = array();
				$json['ts'] = time();
				$json['accounts'] = $acctCate;
				foreach($acctCate as $res){		
					//Calculate a running total
					$val = ($res['credit']-$res['debit']);
					$totals+=$val;
					if($val<0){$val="(".abs($val).")";}
				}
				$json['queries'] = $db->Queries;
				$json['totals'] = $totals;
				echo json_encode($json);
				
			break;
			default:break;
		 }
	 }
?>