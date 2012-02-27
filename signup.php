<?
include_once "header.php";
include_once "functions.php";
/*
[fName] => First 
[lName] => Last 
[uName] => fUser 
[pass1] => thisisthepass 
[pass2] => thisisthemass 
[question] => Mother's Maiden name
[answer] => coollastname 
[Signup] => Signup ) 
*/
$message = "";
if(isset($_POST['Signup']) && $_POST['Signup'] == 'Signup'){ //just a general test to make sure everything is cool
	if(strlen($_POST['uName'])<3){//the username is too small
		$message .= 'The Username is too small, min length is 4 characters<br>';
	}else{
		$user = ucwords(mysql_escape_string($_POST['uName']));
	}
	if($_POST['pass1'] == $_POST['pass2']){//the passwords match
		$password = $_POST['pass1'];
	}else {	$message .= 'The two password fields do not match<br>'; }
	
	$_POST = $db->Mysql_clean($_POST);
	if($message == ""){//there is no current errors time for some databaes fun
		$db = db::getInstance();
		$db->Query("SELECT user_id FROM ".$db->Prefix."users WHERE user='$user';");
		if($db->Count_res() == 1){ //if its 1 that means there is a user by that username already
			$message .= 'The selected username '.$user.' is already in use<br>';
		}else {
			$userName = $_POST['fName']." ".$_POST['lName'];
			$message .= "SELECT user_id FROM ".$db->Prefix."users WHERE user='$userName'";
			$sql = "INSERT INTO ".$db->Prefix."users (username,question,secret,email,user,password) 
			VALUES (
				'$userName',
				'".$_POST['question']."',
				MD5('".$_POST['answer']."'),
				'".$_POST['email']."',
				'$user',
				password('$password')
			)";
			$db->Query($sql);
			if(count($db->Error) == 2){//there was an error
				$message.="There was a Problem processing your signup\n<br>";
				$message .= $sql;
			} else {
				$pass = 1; 
				$message="Your account has been created, <a href=\"index.php\">Sign in</a>";
				//$db->Query("SELECT user_id FROM ".$db->Prefix."users WHERE user='$userName'");		
				$userId = $db->Lastid;
				$startValue = $_POST['starting'];
				include_once "new_user.php";
				
			}
		}
			
	}
}if(!isset($pass)){$pass=0;}//catch an error
$smarty->assign('pass',$pass);
$smarty->assign('message',$message);
$smarty->assign('content','signup.tpl');
$smarty->display("body.tpl");
?>