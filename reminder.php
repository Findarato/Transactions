<?
/*
Started August 14, 2007
This will create a list of reminders and allow the user to click them off as being finished.
I am thinking about having a 3 way, off, middle on.
*/
	$remind = $userinfo -> Get_reminder($userinfo -> User_id);
	
	$smarty->assign('reminder',$remind);
?>