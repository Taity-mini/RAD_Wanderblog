<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (1504693)
 * Date: 07/12/2015
 * Time: 14:41
 * Functions Class for WanderBlog
 */

//Country DropDown Queries

$queryCountries = "SELECT countryID, country_name FROM countries ORDER BY countryid ";
$mainResult = $db->query($queryCountries);

//Boolean variables
$validation_error = false;
$error = false;
$username_check = false;

//Registration Stuff..
if (isset($_POST["submit"]))
{
    //Get data from form

    $fields = array('username', 'password', 'password2', 'email', 'email2', 'FirstName', 'LastName', 'country', 'bio');


    foreach ($fields AS $fieldname) { //Loop trough each field
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
            echo 'Field ' . $fieldname . ' misses!<br />'; //Display error with field
            $error = true; //Yup there are errors
        }
    }
    //If all fields are filled in then proceed
    if (!$error)
    {
        $data = array();
        foreach ($fields AS $fieldname) { //Loop trough each field
            $fieldname = $_POST[$fieldname]; //grab from form
            //echo $fieldname;
            $fieldname = mysqli_real_escape_string($db, $fieldname); //prevent from SQL injection
            $data[] = $fieldname;
        }


        //set variables from array data
        $username = $data[0];
        $password = $data[1];
        $password2 = $data[2];
        $email = $data[3];
        $email2 = $data[4];
        $FirstName = $data[5];
        $LastName = $data[6];
        $country = $data[7];
        $bio = $data[8];

        //Check if userExisits
        $userExists = "SELECT userName FROM users WHERE userName='$username'";
        $result = mysqli_query($db, $userExists);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if (mysqli_num_rows($result) == 1) {
            echo "Sorry...This username already exist...";
            $username_check = true;
        }

        if (!$username_check) {
            //Validation checks

            //Check if passwords match
            if(!isEqual($password, $password2))
            {
                $validation_error = true;
                echo "Passwords don't match!";
            }

            //Check if email addreses match
            if(!isEqual($email, $email2))
            {
                $validation_error = true;
                echo "Emails don't match!";
            }

            if (!$validation_error)
            {

                //convert password to md5
                $password = md5($password);
                $defaultImage = "./Res/default-photo.jpg";

                //Finally add users to db
                $insert = "INSERT INTO users (groupID,userName,password, first_Name, last_Name, country, email, bio)VALUES (21,'$username','$password', '$FirstName' , '$LastName ',  '$country', '$email', '$bio')";
                $result = mysqli_query($db, $insert);
                
                $userQuery = "SELECT userID FROM users WHERE userName = '$username'";
                $result1 = mysqli_query($db, $userQuery);
                $resultFetchArray = mysqli_fetch_array($result1);
                $userid = $resultFetchArray['userID'];
                
                $insert1 = "INSERT INTO picture_gallery_users (filePath, photoDesc, userID) VALUES ('$defaultImage','default image','$userid')";
                $result1 = mysqli_query($db, $insert1);

                if ($result) {
                    echo "Thank You! you are now registered.";
                }
                else{
                    echo "User registration failed";

                }

            }

        }
    }
}
?>

<h1><?php echo $content_header ?></h1>
<div id="Content-inner">


    <br/>

    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
        <table align="center">
            <tr>
                <td>
                    Username:
                </td>
                <td colspan="3">
                    <input type="text" name="username" maxlength="60"></td>
            </tr>
            <tr>
                <td>
                    Password:
                </td>
                <td colspan="3">
                    <input type="password" name="password" maxlength="10">
            </tr>
            <tr>
                <td>
                    Confirm Password:
                </td>
                <td colspan="3">
                    <input type="password" name="password2" maxlength="10"></td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td colspan="3">
                    <input type="text" name="email" maxlength="100"></td>
            </tr>
            <tr>
                <td>
                    Confirm Email
                </td>
                <td colspan="2">
                    <input type="text" name="email2" maxlength="100"></td>
            </tr>
            <tr>
                <td>
                    First Name
                </td>
                <td colspan="2">
                    <input type="text" name="FirstName" maxlength="50"/></td>
            </tr>
            <tr>
                <td>
                    Last Name
                </td>
                <td colspan="3">
                    <input type="text" name="LastName" maxlength="50"></td>
            </tr>
            <tr>
                <td>
                    Country
                </td>
                <td colspan="3">
                    <select name="country">
                        <option value="" selected>Please select a country</option>
                        <?php
                        //Select all countries from table as a dropdown
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
                <td>Bio</td>
                <td><textarea rows="3" cols="22" name = "bio" id = "bio" maxlength = "500">Type here!</textarea></td>
            </tr>
            <tr>
                <td>
                    &nbsp;</td>
                <td>
                    <input type="submit" name="submit" value="Register"/></td>
                <td>
                </td>
                <td>
                    <input type="reset"/></td>
            </tr>
        </table>
    </form>
    <br/>
</div>
<br/>
