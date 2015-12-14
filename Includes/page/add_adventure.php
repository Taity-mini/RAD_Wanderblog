<?php
/**
 * Created by PhpStorm.
 * User: RAD
 * Date: 12/12/2015
 * Time: 16:50
 * Adventure Adding form
 */

            $insert = "INSERT INTO pages (title,trip_country, tags, userID, trip_Date, mod_Date)VALUES ('$title','$trip_country', NULL , '$userID',  '$trip_Date', '$mod_Date')";
            $result = mysqli_query($db, $insert);

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
