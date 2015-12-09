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

    //Registration Stuff..
    if(isset($_POST["submit"])) {
        //Get data from form

        $fields = array('username', 'password', 'password2', 'password', 'email', 'email2', 'FirstName', 'LastName', 'country');

        $error = false; //No errors yet
        foreach($fields AS $fieldname) { //Loop trough each field
            if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
                echo 'Field '.$fieldname.' misses!<br />'; //Display error with field
                $error = true; //Yup there are errors
            }
        }
if(!$error) {
    foreach($fields AS $fieldname) { //Loop trough each field
            $fieldname = $_POST[$fieldname];


        }
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
            <input type="password" name="pass" maxlength="10">
    </tr>
    <tr>
        <td >
            Confirm Password:
        </td>
        <td colspan="3">
           <input type="password" name="pass2" maxlength="10"></td>
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
