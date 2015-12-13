<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (150463)
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

}

?>
<h1><?php echo $content_header ?></h1>
<div id ="Content-inner">
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
            <td>  <input name="submit" style="text-align: center" type="submit" value="Add Adventure" /></td>
            <td>  <input type="reset" value="Reset" /></td>
        </tr>
    </table>
    <br />
</div>
<br\>
