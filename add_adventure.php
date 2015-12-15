<?php
/**
 * Created by PhpStorm.
 * User: RAD
 * Date: 12/12/2015
 * Time: 16:50
 * Adventure Adding form
 */

$error = false;
//Country DropDown Queries
$queryCountries = "SELECT countryID, country_name FROM countries ORDER BY countryid ";
$mainResult = $db->query($queryCountries);
$target_dir = "Res/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

if (isset($_POST["submit"])){
$fields = array('title', 'trip_country', 'trip_Date');

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
    $trip_Date = date('Y-m-d', strtotime($data[2]));
    $mod_Date = date('Y-m-d');
    if(!empty($_SESSION['userID'])){
        $userID = $_SESSION['userID'];
        echo $userID;
    }
    
     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
     if($check !== false){
        echo "File is an image - " . $check["mime"] . ".";
         $uploadOk = 1;
     }
     else{
        echo "File is not an image";
        $uploadOk = 0;
     }
    
    
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

    } 
    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $insert = "INSERT INTO pages (title,trip_country, tags, userID, trip_Date, mod_Date)VALUES ('$title','$trip_country', NULL , '$userID',  '$trip_Date', '$mod_Date')";
            $result = mysqli_query($db, $insert);
            if ($result) {
            $query ="SELECT pageID FROM pages WHERE title = '$title' limit 1";
            $result2 = mysqli_query($db, $query);
            $array = mysqli_fetch_array($result2);
            $output = $array['pageID'];
            $name =  $_FILES["fileToUpload"]["name"];
            $filePath = "Res/" . basename($name);
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $insert1 = "INSERT INTO picture_gallery_pages (filePath, pageID) VALUES ('". mysqli_real_escape_string($db, $filePath)."', $output)";
            $result1 = mysqli_query($db, $insert1) or die(mysqli_error($db));
            echo "Adventure Succesfully Added.";
            }
        }
        else{
             echo "User registration failed";
            }

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
            <td>Adventure Title</td>
            <td><input type="text" name="title" maxlength="60"></td>
        </tr>
        <tr>
            <td>Trip Country</td>
            <td>
                <select name="trip_country">
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
            <td>Trip Date</td>
            <td><input maxlength="10" name="trip_Date" id="datepicker"  type="text" /></td>
        </tr>
        <tr>
            <td>Trip Images</td>
            <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
        </tr>
        <tr>
            <td><input name="submit" style="text-align: center" type="submit" value="Add Adventure" /></td>
            <td><input type="reset" value="Reset" /></td>
        </tr>
    </table>
        <br/>
        <h2>Trip Pictures</h2>
    </form>
    <br />
</div>
<br\>
