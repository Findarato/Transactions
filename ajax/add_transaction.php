<?php
	header('Content-type: application/json');
    include("../small_header.php");
	if(isset($_SESSION["user"])){//There is an active loged in user
		$user = unserialize($_SESSION["user"]);
		if(isset($_GET["add"]) && $_GET["add"]=="yes" && !isset($done)){//This is a post 
			$user -> Add($_GET['type'],$_GET['ammount'],$_GET['subCategory'],"NOW()",$_GET['account'],$_GET['note']);
			$done = true;
			$response["message"] = "Transaction entered Successfully";
		}else if(isset($_GET['fuel_tracker']) && $_GET['fuel_tracker']=="add") {
			include_once("fuel/fuel.php"); //should include a fuel posting.
		}else{
			$response["message"] = "There was an error with the data being passed";
		}
	} else{
		$response["message"] = "There was an error accessing your session";
	}
	echo json_encode($response);
?>