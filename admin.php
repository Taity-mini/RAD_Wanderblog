<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (1504693)
 * Date: 07/12/2015
 * Time: 14:04
 */
//Main Admin Page

//User Management
$users_table = mysqli_query (($db),("SELECT userID, groupID, userName, first_Name, last_Name, country, email FROM users"));
$permissions_table = mysqli_query (($db),("SELECT * FROM group_permissions"));


//Group Management
$groups_table = ("SELECT * FROM `group`");
$groups = mysqli_query($db, $groups_table);

//Permission Management
$permissions_table = ("SELECT * FROM group_permissions");
$permissions = mysqli_query($db, $permissions_table);

//Adventures
$pages_table = mysqli_query (($db),("SELECT * FROM pages"));

?>

<h1><?php echo $content_header ?></h1>
<div id ="Content-inner">

    <h2>Adventure Management</h2>
    <?php
    if (mysqli_num_rows($pages_table) > 0)
    {
        print "
        <table border='1' cellspacing='0'>
            <tr>
                <td>Adventure ID</td>
                <td>User</td>
                <td>Title</td>
                <td>Trip Country</td>
                <td>bio</td>
                <td>tags</td>
                <td>Trip Date</td>
                <td>Last Updated</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>";
        while($info = mysqli_fetch_array($pages_table))
        {   $deleteID = $info['PageID'];
            $pageUser =  $info['userID'];
            $userName = mysqli_query($db,"SELECT * FROM `users` WHERE userID = '$pageUser'");
            $user_info2 = mysqli_fetch_array($userName) or die;
            $trip_Date =date('d/m/Y',strtotime($info['trip_Date']));
            $mod_date =date('d/m/Y',strtotime($info['mod_Date']));
            echo "<trstyle='background-color:#000000;'>";
            echo "<td>" . $info['PageID'] . "</td>";
            echo "<td>" . $user_info2['userName'] . "</td>";
            echo "<td>" . $info['title'] . "</td>";
            echo countryName($db,$info['trip_country']);
            echo "<td>" . $info['bio'] . "</td>";
            echo "<td>" . $info['tags'] . "</td>";
            echo "<td>" . $trip_Date. "</td>";
            echo "<td>" . $mod_date. "</td>";
            echo '<td><a href="./?page=edit_adventure&id='. $info['PageID'] .'">Edit</a></td>';
            echo '<td><a href ="#" onclick="deletePage('.$deleteID.')">Delete</a></td>';
            echo "</tr>";
        }
        echo"</table>";
    }
    else
    {   //No users? Register then!
        echo"<p>No adventures registered on the system, please <a href='./?page=add_adventure'>Add adventure</a></p>";
    }
    ?>


   <h2>User Management</h2>
<?php
//Check if any users are in table then display results
if (mysqli_num_rows($users_table) > 0)
{
    print "
        <table border='1' cellspacing='0'> 
            <tr>
                <td>User ID</td>
                <td>Group ID</td>
                <td>UserName</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Country</td>
                <td>Email</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>";
     while($info = mysqli_fetch_array($users_table))
      {
          echo "<trstyle='background-color:#000000;'>";
          echo "<td>" . $info['userID'] . "</td>";
          echo "<td>" . $info['groupID'] . "</td>";
          echo "<td>" . $info['userName'] . "</td>";
          echo "<td>" . $info['first_Name'] . "</td>";
          echo "<td>" . $info['last_Name'] . "</td>";
          echo countryName($db,$info['country']);
          echo "<td>" . $info['email'] . "</td>";
          echo '<td><a href="./?page=edit_user&id='. $info['userID'] .'">Edit</a></td>';
          echo userMatch($info['userID'],$_SESSION["userID"]);
          echo "</tr>";
      }
     echo"</table>";
    }
else
{   //No users? Register then!
    echo"<p>No users registered on the system, please <a href='./?page=register'>Register</a></p>";
}
?>
    <?php
    if (mysqli_num_rows($permissions) > 0) {
        echo "<h2>Group Management</h2>";

        if (mysqli_num_rows($groups) > 0) {
            print"
        <table border=\"1\">
        <tr>
            <td>Group ID</td>
            <td>Group Name</td>
            <td>Permission Name</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>";
            while ($info = mysqli_fetch_array($groups)) {
                echo "<trstyle='background-color:#000000;'>";
                echo "<td>" . $info['groupID'] . "</td>";
                echo "<td>" . $info['groupName'] . "</td>";
                echo groupName($db, $info['permissionID']);
                echo '<td><a href="./?page=edit_group&id='. $info['groupID'] .'">Edit</a></td>';
                echo groupInUse($db, $info['groupID'], "Row");
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No groups registered add one below:</p>";

        }
        echo "<h2>Add Group</h2>";
        include("includes/group/add_group.php");
    }

    ?>

    <h2>Permissions Management</h2>
    <?php
    if (mysqli_num_rows($permissions) > 0) {
        print"
        <table border=\"1\">
        <tr>
            <td>Permission ID</td>
            <td>Permission Name</td>
            <td>Create Content</td>
            <td>Create Comments</td>
            <td>Vote</td>
            <td>Edit Vote (Admin)</td>
            <td>Edit Content</td>
            <td>Edit Comments</td>
            <td>View Content</td>
            <td>View Comments</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>";
        while ($info = mysqli_fetch_array($permissions)) {
            echo "<trstyle='background-color:#000000;'>";
            echo "<td>" . $info['permissionID'] . "</td>";
            echo "<td>" . $info['permissionName'] . "</td>";
            echo "<td>" . $info['create_Content'] . "</td>";
            echo "<td>" . $info['create_Comments'] . "</td>";
            echo "<td>" . $info['vote'] . "</td>";
            echo "<td>" . $info['edit_Vote_Admin'] . "</td>";
            echo "<td>" . $info['edit_Content'] . "</td>";
            echo "<td>" . $info['edit_Comments'] . "</td>";
            echo "<td>" . $info['view_Content'] . "</td>";
            echo "<td>" . $info['view_Comments'] . "</td>";
            echo '<td><a href="./?page=edit_perm&id='. $info['permissionID'] .'">Edit</a></td>';
            echo permissionInUse($db, $info['permissionID'], "Row");
            echo "</tr>";

        }
        echo"</table>";
    }
    else
    {
        echo "<p>No permissions registered add one below:</p>";
    }

    echo "<h2>Add Permission</h2>";
    include("includes/group/add_permission.php");

    ?>
</div>