<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (1504693)
 * Date: 16/12/2015
 * Time: 18:00
 */

$error = false;
$display_results = false;

if (isset($_POST['adventure'])) {

    if (!isset($_POST['find']) || empty($_POST['find']))
    {
        echo 'No search query entered!<br />'; //Display error with field
        $error = true; //Yup there are errors
    }

    if(!$error) {


        $find = mysqli_real_escape_string($db, $_POST['find']);
        $field = mysqli_real_escape_string($db, $_POST['field']);

        $search_results = mysqli_query($db, "SELECT * FROM `pages` WHERE $field LIKE '%$find'") or die(mysqli_error($db));

        if($search_results)
        {
            $display_results = true;
        }
        else
        {
            $display_results = false;
        }

        //$info = mysqli_query("SELECT @N := @N +1 AS number, ID, Card_ID, Exercise, Weight, Sets_reps, exercise_type FROM weight_cards WHERE $field LIKE '%$find%' AND User_ID ='$row[ID]'") or die(mysql_error());

    }
}
?>


<h1><?php echo $content_header ?></h1>
<div id ="Content-inner">
    <form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="post" style="text-align: center">
        Search for where: <Select name="field">
            <Option value="title">Title</option>
            <Option value="userID">User ID</option>
            <Option value="trip_country">Trip Country</option>
            <Option value="tags">Tags</option>
        </Select>
        = <input type="text" name="find" />
        <input type="submit" name="adventure" value="Search" />
    </form>


<?php
if (isset($_POST['adventure'])) {
    if ($display_results) {
        print "
        <table border='1' cellspacing='0'>
            <tr>
                <td>Adventure ID</td>
                <td>Adventure Title</td>
                <td>Author</td>
                <td>Trip Country</td>
                <td>Tags</td>
                <td>View Adventure</td>
            </tr>";
        while ($info = mysqli_fetch_array($search_results)) {
            echo "<trstyle='background-color:#000000;'>";
            echo "<td>" . $info['PageID'] . "</td>";
            echo "<td>" . $info['title'] . "</td>";
            echo "<td>" . $info['userID'] . "</td>";
            echo countryName($db, $info['trip_country']);
            echo "<td>" . $info['tags'] . "</td>";
            echo '<td><a href="./?page=adventure&id=' . $info['PageID'] . '">View</a></td>';
            echo "</tr>";
        }
        echo "</table>";
    } elseif (!$display_results) {
        echo "No results found";
    }
}
?>
</div>