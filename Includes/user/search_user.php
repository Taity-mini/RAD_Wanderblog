<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (1504693)
 * Date: 16/12/2015
 * Time: 21:11
 * Search Author Form
 */

$error = false;
$display_results = false;

if (isset($_POST['user'])) {

    if (!isset($_POST['find']) || empty($_POST['find']))
    {
        echo 'No search query entered!<br />'; //Display error with field
        $error = true; //Yup there are errors
    }

    if(!$error) {

        $find = mysqli_real_escape_string($db, $_POST['find']);
        $field = mysqli_real_escape_string($db, $_POST['field']);
        echo $field;
        if($field == "groupID")
        {
            echo "Field check";
            //$result = mysqli_query($db,"SELECT userID FROM `users` WHERE userName = '$field'");
            $userID = $db->query("SELECT `groupID` FROM `group` WHERE groupName = '$field'")->fetch_object()-groupID;
            $field = $userID;
            echo $field;
            $search_results = mysqli_query($db, "SELECT * FROM `users` WHERE $field LIKE '%$find%'") or die(mysqli_error($db));
        }

        elseif($field == "country")
        {
            $country_query = $db->query("SELECT countryID FROM countries WHERE country_name LIKE '%$find%'")->fetch_object()->countryID;
            $find = $country_query;
            $search_results = mysqli_query($db, "SELECT * FROM `users` WHERE $field LIKE '%$find%'") or die(mysqli_error($db));
        }

        else
        {
            $search_results = mysqli_query($db, "SELECT * FROM `users` WHERE $field LIKE '%$find%'") or die(mysqli_error($db));
        }





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
            <Option value="userName">Author UserName</option>
            <Option value="first_Name">First Name</option>
            <Option value="last_Name">Last Name</option>
            <Option value="country">Country</option>
        </Select>
        = <input type="text" name="find" />
        <input type="submit" name="user" value="Search" />
    </form>


    <?php
    if (isset($_POST['user'])) {
        if ($display_results) {
            print "
        <table border='1' cellspacing='0'>
            <tr>
                <td>Author ID</td>
                <td>Author Group</td>
                <td>Author Alias</td>
                <td>Author First Name</td>
                <td>Author Last Name</td>
                <td>Trip Country</td>
                <td>View Adventure</td>
            </tr>";
            while ($info = mysqli_fetch_array($search_results)) {
                echo "<trstyle='background-color:#000000;'>";
                echo "<td>" . $info['userID'] . "</td>";
                echo "<td>" . $info['userName'] . "</td>";
                echo "<td>" . $info['first_Name'] . "</td>";
                echo "<td>" . $info['last_Name'] . "</td>";
                echo countryName($db, $info['country']);
                echo '<td><a href="./?page=view_user&id=' . $info['userID'] . '">Profile</a></td>';
                echo "</tr>";
            }
            echo "</table>";
        } elseif (!$display_results) {
            echo "No results found";
        }
    }
    ?>
</div>
