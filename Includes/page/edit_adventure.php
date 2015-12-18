<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 16/12/2015
 * Time: 14:41
 * Edit Adventure Form
 */

$getid = htmlentities($_GET['id']);
$error = false;

$result = mysqli_query($db, "SELECT * FROM `pages` WHERE PageID = '$getid'");
$info = mysqli_fetch_array($result) or die;
$userID = $info['userID'];
//$trip_Date_Input =date('d/m/Y',strtotime($info['trip_Date']));
$date =date('d/m/Y',strtotime($info['trip_Date']));


$user = mysqli_query($db,"SELECT * FROM `users` WHERE userID = '$userID'");
$user_info = mysqli_fetch_array($user) or die;


//Country Dropdown
$queryCountries = "SELECT countryID, country_name FROM countries ORDER BY countryid ";
$country = $db->query($queryCountries);

if (isset($_POST["update"])) {

    $fields = array('title', 'trip_country', 'tags', 'trip_Date');

foreach ($fields AS $fieldname) { //Loop trough each field
    if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
        echo 'Field ' . $fieldname . ' misses!<br />'; //Display error with field
        $error = true; //Yup there are errors
    }
}
//If all fields are filled in then proceed
if (!$error) {


    $data = array();
    foreach ($fields AS $fieldname) { //Loop trough each field
        $fieldname = $_POST[$fieldname]; //grab from form
        echo $fieldname;
        $fieldname = mysqli_real_escape_string($db, $fieldname); //prevent from SQL injection
        $data[] = $fieldname;
    }


    $title = $data[0];
    $trip_country = $data[1];
    $tags = $data[2];
    $trip_Date = date('Y-m-d', strtotime($data[3]));
    echo $trip_Date;
    $mod_Date = date('Y-m-d');
/*    if (!empty($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        echo $userID;
    }*/
    $id = $info['PageID'];

    //update page
    $update_page = mysqli_query($db, ("UPDATE `pages` SET `title` = '$title', `trip_country`='$trip_country', `tags` = '$tags', `trip_Date` = '$trip_Date', `mod_Date` = '$mod_Date'  WHERE PageID = '$id'"));
    if ($update_page) {
        echo "<script> alert('Adventure Updated Successfully');</script>";
        $pageID = $info['pageID'];
        $return = "./?page=adventure&id=".$pageID;
        header("Location:" .$return);
    } else {
        echo "<script> alert('Adventure Update Failed');</script>";
        $pageID = $info['pageID'];
        $return = "./?page=adventure&id=".$pageID;
        header("Location:" .$return);
    }


}
}

?>
<h1><?php echo $content_header ?></h1>
<div id ="Content-inner">
    <form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="post" style="text-align: center" enctype="multipart/form-data">
        <h2>Adventure Details</h2>
        <table border ="1" align="center">
            <tr>
                <td>Adventure ID:</td>
                <td colspan="2"><?php echo $info['PageID'];?></td>
            </tr>
            <tr>
                <td>Author</td>
                <td colspan="2"><?php echo $user_info['userName'];?></td>
            </tr>
            <tr>
                <td>Adventure Title</td>
                <td><input type="text" name="title" maxlength="60" value="<?php echo $info['title']; ?>"> </td>
            </tr>
            <tr>
                <td>Trip Country</td>
                <td>
                    <select name="trip_country">
                        <?php
                        //Select all countries from table as a dropdown then select based on countryID on pages table
                        while ($rowCerts = $country->fetch_assoc()) {
                            $selected = ($info['trip_country'] == $rowCerts['countryID']) ? 'selected="selected"' : '';
                            echo '<option '.$selected.' value="' . $rowCerts['countryID'] . '">' .
                                $rowCerts['country_name'] . '</option>';
                        }
                        ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Tags</td>
                <td><input maxlength="20" name="tags"  type="text" value="<?php echo $info['tags']; ?>" /></td>
            </tr>
            <tr>
                <td>Trip Date</td>
                <td><input maxlength="10" name="trip_Date" id="datepicker"  type="text" value="<?php echo $date; ?>" /></td>
            </tr>
            <tr>
                <td><input name="update" style="text-align: center" type="submit" value="Update Adventure" /></td>
                <td><input type="reset" value="Reset" /></td>
            </tr>
        </table>
    </form>
    <br />
</div>
<br\>