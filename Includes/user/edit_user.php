<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (1504693)
 * Date: 11/12/2015
 * Time: 16:41
 */

$getid = $_GET['id'];

//$users = "SELECT * FROM `users` WHERE `userID` = `$getid`";
$result = mysqli_query($db,"SELECT * FROM `users` WHERE userID = '$getid'");
//$mainResult = $db->query($users);
$info = mysqli_fetch_array($result) or die;

//Group DropDown
$groups_table = ("SELECT * FROM `group`");
$groups = mysqli_query($db, $groups_table)  or die;;

//Country Dropdown
$queryCountries = "SELECT countryID, country_name FROM countries ORDER BY countryid ";
$country = $db->query($queryCountries);

if(isset($_POST['update'])) {
//form variables
    $groupID = $_POST['groupID'];
    $firstName = $_POST['first_Name'];
    $lastName = $_POST['last_Name'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $id  =$info['userID'];

$update_user= mysqli_query($db,("UPDATE users SET groupID = '$groupID', first_Name='$firstName', last_Name='$lastName', country='$country', email='$email'  WHERE userID = '$id'"));
if($update_user){
    echo "User successfully updated!";
    $page = "./?page=admin";
    header("Refresh: 2; URL=\"" . $page . "\"");
} else{
    echo("<br>Input data is fail");
}
}
?>
<h1><?php echo $content_header. "ID :" . $getid?></h1>
<div id ="Content-inner">
    <form action="<?php echo htmlentities ($_SERVER['REQUEST_URI']); ?>" method="post" style="text-align: center">
        <table border="1" align="center">
            <tr>
                <td>UserID</td>
                <td colspan="2"><?php echo $info['userID'];?></td>
            </tr>
            <tr>
                <td>Username</td>
                <td colspan="2"><?php echo $info['userName'];?></td>
            </tr>
            <tr>
                <td>Group</td>
                <td colspan="2">
                    <select name="groupID">
                        <?php
                        //Select all groups from table as a dropdown

                        while ($rowCerts = $groups->fetch_assoc()) {
                            $selected = ($info['groupID'] == $rowCerts['groupID']) ? 'selected="selected"' : '';
                            echo '<option '.$selected.' value="' . $rowCerts['groupID'] . '">' .
                                $rowCerts['groupName'] . '</option>';

                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>First Name</td>
                <td colspan="2"><input type="text" name="first_Name" maxlength="60" value="<?php echo $info['first_Name'];?>" style="width: 200px"></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td colspan="2"><input type="text" name="last_Name" maxlength="60" value="<?php echo $info['last_Name'];?>" style="width: 200px"></td>
            </tr>
            <tr>
                <td>Country</td>
                <td colspan="2">
                    <select name="country">
                        <?php
                        //Select all countries from table as a dropdown


                        while ($rowCerts = $country->fetch_assoc()) {
                            $selected = ($info['country'] == $rowCerts['countryID']) ? 'selected="selected"' : '';
                            echo '<option '.$selected.' value="' . $rowCerts['countryID'] . '">' .
                                $rowCerts['country_name'] . '</option>';
                        }
                        ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td colspan="2"><input type="text" name="email" maxlength="60" value="<?php echo $info['email'];?>" style="width: 200px"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
            <input name="update" style="text-align: center" type="submit" value="Update User" /></td>
                <td>
            <input type="reset" value="Reset" /></td>
            </tr>
        </table>
    </form>


