<?php

session_start();

include("./includes/connect.php");

if (isset($_POST['loginSubmit'])){

	$user = $_POST['username'];
	$pass = md5($_POST['password']);

	$username = stripslashes($user);
	$password = stripslashes($pass);
	$password = mysql_real_escape_string($pass);
	$password = mysql_real_escape_string($pass);

	$query = "SELECT * FROM users WHERE userName = '$user' AND password = '$pass'";

	$result = mysqli_query($db, $query);

	$count = mysqli_num_rows($result);

	echo "" + $count;
	
	echo "" + $count['groupID'];

	if($count==1){

			$_SESSION["username"] = $user;
			$_SESSION["password"] = $pass;
			$_SESSION["groupID"] = $count['groupID'];
			echo $_SESSION['username'];
			//header("Location: index.php");

	}
	else {

		echo "Wrong Username or Password";

	}


}




?>
