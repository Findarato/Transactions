<?php //started December 24, 2007
require_once("db.class.php");
class user{ //The user class for transactions 4.5

///////////////////////Basic Configuration and Variable definition
	//Public Variables
	public $Username = ""; //Combination of Firstname and Lastname
	public $User_id = 0; //user ID as index of user table
	public $Accounts = array(); //Stores user account information
	public $Email = ""; //Email address
	public $Config = array(); //config values in associative array
	public $Payment_id = ""; //ID of the payments parent
	public $Account_main = 0; //ID of the Primary account
	//private variables
	private $dbconfig = array();
	

///////////////////////Constructor
	function user($user_id="",$password=""){//create and load the values from the table
		//No user passed means its a blank session
		$db = db::getInstance();

		if($user_id=="" && $password=="" && $db == ""){//blank session
				$this -> invalid_user();
		}else{//validate user and create the session
			$tusers	= "fin_users";
			$res = $db -> Query("SELECT user_id,username,email FROM ".$db->Prefix."users WHERE user='$user_id' AND password=password('$password')");
			$this -> checkerror($db);
			if($db -> Count_res() == 1){//this is the result we are looking for
				$line = $db -> Format("assoc");
				$this -> Username = $line['username'];
				$this -> User_id = $line['user_id'];
				$this -> Email = $line['email'];
				//Must get accounts onfile
				$res2 = $db -> Query("SELECT id FROM ".$db->Prefix."categories WHERE cate_name='payment' AND user_id=".$this->User_id.";");
				echo $db->Lastsql;
				$line = $db -> Format("row");
				$this -> Payment_id = $line[0];
				$this -> dbconfig = $this -> Load_db_config($this -> User_id);
				$this -> Loadaccounts(); //load the accounts into the table
				$this -> get_closing_balance();
			}else{//not a valid user
				$this -> invalid_user();

			}
		}
	}
///////////////////////Public Functions	
/**
 * Loads up the accounts from the account table
 * @return nothing
 */
	public function Loadaccounts(){//load accounts into the object
		//can be used to reload the account info
		$db = db::getInstance();
		$db -> Query("
		select 
			TRUNCATE(SUM(l.credit),1) AS credit, 
			TRUNCATE(SUM(l.debit),1) AS debit,
			TRUNCATE(SUM(l.credit)-SUM(l.debit),2) AS total, 
			c.cate_name,
			a.acct_name, 
			a.acct_type,
			a.id,
			a.main AS main,
			a.cate_id,
			a.interest
		FROM ".$db -> Prefix."ledger AS l 
		RIGHT JOIN ".$db -> Prefix."accounts AS a 
		ON (a.id=l.acct_id) 
		LEFT JOIN ".$db -> Prefix."categories AS c ON (a.cate_id=c.id)
		WHERE (l.user_id=".$this -> User_id." OR c.user_id=".$this -> User_id.")
    	GROUP BY a.id, a.acct_type;");
		$acct = $db -> Format("assoc_array",false,"none");
		$cnt = 0;
		foreach($acct as $k=>$a){
			$this -> Accounts[$a["id"]]	= $acct[$cnt];
			$cnt++;
		}
		// = $db -> Format("assoc_array"); //hope this works
		foreach ($this->Accounts as $ac){ if($ac['main'] == 1) {$this->Account_main = $ac['id'];} } //get the main account ID
	}
	/**
	 * Checks to see if the account id supplied is a account the user has access to
	 * @return booleen 
	 * @param string $acct_id
	 */
	public function Checkaccounts($acct_id){//designed to check if an account ID is one the user owns
		foreach($this->Accounts as $act){ if(intval($act['id'])==intval($acct_id)) {return true;}}
		return false; //this is not a valid account
	}
	public function Load_db_config($user_id){ //load the config from the database
		//Pull the information stored in the database
		$db = db::getInstance();
		$db -> Query("SELECT table_prefix FROM config");
		$this -> checkerror($db); //best be sure
		$conf = $db -> Format("assoc");
		$db -> Prefix = $conf['table_prefix'];
		$res = $db -> Query("SELECT * FROM ".$db -> Prefix."user_config WHERE user_id=$user_id LIMIT 1");
		if($db -> Count_res() != 1){//there is no user settings
			$this -> buildconfig($user_id);	
		}
		$this -> checkerror($db); //best be sure
		$this -> Config = $db -> Format("assoc");
		
		return $conf;
	}
	public function Add($type,$ammount,$category,$date,$account,$note=""){
		if($this->Checkaccounts($account)){ //makes sure that everything is ok and your not trying to hijack a different account
			$db = db::getInstance();
			$sql = "INSERT INTO ".$db -> Prefix."ledger(";
			switch($type){
				case "d":
					$sql.="debit,";
				break;
				case "c":
					$sql.="credit,";
				break;
				default:
					//this should never happen
					die("You really broke something now");
				break;
			}	
			$sql .= "category,note,user_id,dt,acct_id) VALUES (".
			$ammount.",".$category.",'".mysql_escape_string($note)."',".$this -> User_id.",".$date.",".$account.")";
			$db -> Query($sql);
			$this -> checkerror($db);
		}else{return false;}
	}
	public function Add_reminder($title,$body,$dt){ //Used to add a new reminder to a specific date
		$db = db::getInstance();
		$formatedTime = gmdate("Y-m-d H:i:s", strtotime($dt));
		//insert the new reminder and properly format the fields
		$db -> Query("INSERT INTO ".$db->Prefix."reminders (dt,title,text,status,user_id) 
		VALUES ('".$formatedTime."','".mysql_escape_string($title)."','".mysql_escape_string($body)."',0,".$this->User_id.");");
	}
	public function Update_reminder($title,$body,$dt,$status){//status should always be finished which 
		$db = db::getInstance();	
	}
	public function Finish_reminder($id,$user_id){ //small update query to finish a reminder.
		//not nessary but useful.  More of a security measure
		if($user_id != $this -> User_id)
			$user_id = $this -> User_id; 
			
		$db -> Query("UPDATE ".$db->Prefix."reminders SET completed_dt=NOW(),status=2 WHERE id=".$id." AND user_id=".$user_id);
		return true;
	}
	public function Get_reminder($user_id){
		//not nessary but useful.  More of a security measure
		if($user_id != $this -> User_id)
			$user_id = $this -> User_id; 
		$db = db::getInstance();
		$db -> Query("SELECT id,dt,title,text,status FROM ".$db -> Prefix."reminders WHERE user_id=".$user_id." AND completed_dt = '0000-00-00 00:00:00' ORDER BY dt DESC");
		$res = $db -> Format("assoc_array");
		return $res;
	}
	public function Add_category($parent,$name){//used to add a new category
		$db = db::getInstance();
		$db->Query("INSERT INTO ".$db->Prefix."categories (user_id,cate_name,parent) VALUES (".$this->User_id.",'".mysql_real_escape_string($name)."',$parent);");
		$this -> checkerror($db);
	}
///////////////////////Private Functions	
	private function invalid_user(){ //to make less code
		$this -> Username = "Guest";
		$this -> User_id = -1;
		$this -> Accounts = array("Empty");
		$this -> Email = "guest@host.com";
	}
	/* This is an old function that has been depreciated
	private function include_config($config){//simple function to call and fill in the config values
		include_once $config;
		$return['db'] = $dbase;
		$return['user'] = $user;
		$return['pass'] = $password;
		$return['address'] = $address;
		$return['userTbl'] = $tusers;
		return $return; //Return the DB connection info		
	}*/
	private function buildconfig($user_id){//this will be for any user that does not have a config
		$db = db::getInstance();
		$db -> query("SELECT results_per_page,date_format,year_ending,theme FROM config");
		$line = $db -> format("assoc");
		$db -> query("INSERT into ".$db -> Prefix . "user_config (user_id,". join(",",array_keys($line)).") 
			VALUES ($user_id,".join(",",$db -> escape_str($line)).")");
		$this -> checkerror($db); //best be sure
	}
	private function get_closing_balance(){//will get all the debits and credits for this account
		//and store the total up to the current year.
		$db = db::getInstance();
		$db -> Query("SELECT SUM(credit) AS credit, SUM(debit) AS debit,acct_id FROM ".$db -> Prefix."ledger WHERE user_id=".$this -> User_id."
			WHERE YEAR(dt)<".date("Y")." GROUP BY acct_id");
	}
	private function checkerror($db){//pass the object
		if(count($db -> Error) == 2) {//there was an error lets see it
			echo "There was an error with the query <br><pre>";
			print_r($db -> Error);
			echo "</pre>";
			$this -> invalid_user(); //always have to set a blank user
			die();
		}
	}
}
?>