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


//Group Management
$groups_table = ("SELECT * FROM group");
$result = mysqli_query($db, $groups_table);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<h1><?php echo $content_header ?></h1>
<div id ="Content-inner">


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
          echo "</tr>";
      }
     echo"</table>";
    }
else
{   //No users? Register then!
    echo"<p>No users registered on the system, please <a href='./?page=register'>Register</a></p>";
}
?>

    <h2>Group Management</h2>
    <?php
    if ($result)
    {

    }
    else
    {
       echo "<p>No groups registered add one below:</p>";
    }

    echo "<h2>Add Group</h2>";
    include("includes/group/add_group.php");

    ?>

</div>
<br />
