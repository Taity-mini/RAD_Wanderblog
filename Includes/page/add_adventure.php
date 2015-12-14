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

if (isset($_POST["submit"]))
{
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

    $insert = "INSERT INTO pages (title,trip_country, tags, userID, trip_Date, mod_Date)VALUES ('$title','$trip_country', NULL , '$userID',  '$trip_Date', '$mod_Date')";
    $result = mysqli_query($db, $insert);

    if ($result) {
        echo "Adventure Succesfully Added.";
    }
    else{
        echo "User registration failed";

    }

}
}
?>
<h1><?php echo $content_header ?></h1>
<h2></h2>
<div id ="Content-inner">
    <form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="post" style="text-align: center">
    <h3>Adventure Details</h3>
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
            <td><input name="submit" style="text-align: center" type="submit" value="Add Adventure" /></td>
            <td><input type="reset" value="Reset" /></td>
        </tr>
    </table>
        <br/>
        <h3>Trip Pictures</h3>
        <div id = "columns">
        <div id = "content-blob">
           <div class = "Picture_Container">
            <img src="temp.jpg" alt="Coffee Shop" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>
                <div id = "content-blob">
           <div class = "Picture_Container">
            <img src="temp.jpg" alt="Coffee Shop" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>
                <div id = "content-blob">
           <div class = "Picture_Container">
            <img src="temp.jpg" alt="Coffee Shop" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>
                <div id = "content-blob">
           <div class = "Picture_Container">
            <img src="temp.jpg" alt="Coffee Shop" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>
                <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>
                <div id = "content-blob">
           <div class = "Picture_Container">
            <img src="temp.jpg" alt="Coffee Shop" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>
                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>
                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>
        </div>


    </form>
    <br />
</div>
<br\>