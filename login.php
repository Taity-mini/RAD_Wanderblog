<?php

session_start();

include("./includes/connect.php");

if (isset($_POST['loginSubmit'])){

	$user = $_POST['username'];
	$pass = md5($_POST['password']);

	$username = stripslashes($user);
	$password = stripslashes($pass);
	$password = mysqli_real_escape_string($pass);
	$password = mysqli_real_escape_string($pass);

	$query = "SELECT * FROM users WHERE userName = '$user' AND password = '$pass'";
	$query1 = "SELECT groupID FROM users WHERE userName = '$user' AND password = '$pass'";

	$result = mysqli_query($db, $query);
	$groupID = mysqli_query($db, $query1);
	echo "" + groupID;
	
	echo "" + $result;

	$count = mysqli_num_rows($result);
	$info = mysqli_fetch_array($result);
	$group = mysqli_fetch_array($groupID);
	
	echo "entered";
	
	if($count==1){
			
			$_SESSION["username"] = $user;
			$_SESSION["password"] = $pass;
			//$_SESSION["groupID"] = $groupID;
			$_SESSION["userID"] = $info['userID'];
			$_SESSION["groupID"] = $group['groupID'];
 			echo $_SESSION['username'];
 			echo "" + groupID;
			header("Location: index.php");

	}
	else {

		echo "Wrong Username or Password";

	}


}




?>
