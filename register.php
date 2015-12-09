<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (1504693)
 * Date: 07/12/2015
 * Time: 14:41
 */

  //Country DropDown Queries

    $queryCountries ="SELECT countryID, country_name FROM countries ORDER BY countryid ";
    $mainResult = $db->query($queryCountries);

    //Boolean variables
    $emailCheck = FALSE;
    $username_check = FALSE;


    //Registration Stuff..
    if(isset($_POST["submit"])) {
        //Get data from form

        $fields = array('username', 'password', 'password2', 'email', 'email2', 'FirstName', 'LastName', 'country');

        $error = false; //No errors yet
        foreach($fields AS $fieldname) { //Loop trough each field
            if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
                echo 'Field '.$fieldname.' misses!<br />'; //Display error with field
                $error = true; //Yup there are errors
            }
        }
        //If all fields are filled in then proceed
if(!$error) {
    $data = array();
    foreach($fields AS $fieldname) { //Loop trough each field
            $fieldname = $_POST[$fieldname]; //grab from form
            echo $fieldname;
            $fieldname = mysqli_real_escape_string($db, $fieldname); //prevent from SQL injection
            $data[] = $fieldname;
        }


    //set variables from array data
    $username = $data[0];
    $password = $data[1];
    $password = md5($password);
    $password2 = $data[2];
    $email = $data[3];
    $email2 = $data[4];
    $FirstName = $data[5];
    $LastName = $data[6];
    $country =$data[7];




  /*  $userExists="SELECT username FROM users WHERE username='$username'";
    $result=mysqli_query($db,$userExists);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result) == 1)
    {
        echo "Sorry...This username already exist...";
        $username_check = true;
    }

    if(!$username_check)
    {*/
/*        $passCheck = false;
        //check if passwords match

        if($password != $password2)
        {
          echo "Passwords don't match";
          $passCheck = true;

        }*/
/*
        if(!$passCheck)
        {*/
            //convert password to md5
           // $password = md5($password);
            //Now check email

/*

            if($email != $email2)
            {
                echo "Emails Don't match";
                $emailcheck = true;
            }


            if(!$emailcheck)
            {*/
                //Finally add users to db
                $insert = "INSERT INTO users (userName,password, first_Name, last_Name, country, email)VALUES ('$username','$password', '$FirstName' , '$LastName ',  '$country', '$email')";
                $result = mysqli_query($db,$insert) or trigger_error("Query Failed! SQL: $insert - Error: ".mysqli_error(), E_USER_ERROR);
                 //$adduser = mysqli_query($db,$insert) or die(mysqli_error($db));
              /*  if($addUser)
                {
                    echo "Thank You! you are now registered.";
                }*/
            }





    }


?>

<h1><?php echo $content_header ?></h1>
<div id ="Content-inner">


    <p>Register Form</p<br />
    <br />
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" > 
<table align="center">
    <tr>
        <td >
            Username:</td>
        <td colspan="3">
            <input type="text" name="username" maxlength="60"></td>
    </tr>
    <tr>
        <td >
            Password:</td>
        <td colspan="3">
            <input type="password" name="password" maxlength="10">
    </tr>
    <tr>
        <td >
            Confirm Password:
        </td>
        <td colspan="3">
           <input type="password" name="password2" maxlength="10"></td>
    </tr>
    <tr>
        <td>
            Email</td>
        <td colspan="3">
            <input type="text" name="email" maxlength="100"></td>
    </tr>
	<tr>
        <td>
            Confirm Email</td>
        <td colspan="2">
            <input type="text" name="email2" maxlength="100"></td>
    </tr>
	<tr>
        <td>
            First Name</td>
        <td colspan="2">
            <input  type="text" name="FirstName" maxlength="50"/></td>
    </tr>
    <tr>
        <td >
            Last Name</td>
        <td colspan="3">
             <input type="text" name="LastName" maxlength="50"></td>
    </tr>
    <tr>
        <td >
            Country</td>
        <td colspan="3">
            <select name="country">
                <option value="" selected>Please select a country</option>
            <?php
                while ($rowCerts = $mainResult->fetch_assoc()) {
                    echo html_entity_decode("<option value=\"{$rowCerts['countryID']}\">");
                    echo html_entity_decode($rowCerts['country_name']);
                    echo "</option>";
                }   
            ?>
       
            </select>
            </td>
    </tr>
    <tr>
        <td >
            &nbsp;</td>
        <td>
           <input type="submit" name="submit" value="Register" /></td>
        <td>
            </td>
        <td>
            <input type="reset" /></td>
    </tr>
</table>
</form>
    <br />
</div>
<br />
