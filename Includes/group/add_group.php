<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (1504693)
 * Date: 09/12/2015
 * Time: 22:11
 */

//Permissions Dropdown for group creation
$queryPermissions = "SELECT permissionID, permissionName FROM group_permissions";
$permissions_dropdown = $db->query($queryPermissions);
$error = false;

if (isset($_POST["group_submit"]))
{
    //Grab Data from field
    $fields = array('groupName','permissionID');
    $data = array();
    foreach ($fields AS $fieldname) { //Loop trough each field
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
            echo 'Field ' . $fieldname . ' misses!<br />'; //Display error with field
            $error = true; //Yup there are errors
        }
        else
        {
            $fieldname = $_POST[$fieldname]; //grab from form
            echo $fieldname;
            $fieldname = mysqli_real_escape_string($db, $fieldname); //prevent from SQL injection
            $data[] = $fieldname;
        }
    }

  if(!$error) {


      //set variables from array data
      $groupName = $data[0];
      $permissionID = $data[1];

      //Insertion Queries

      //$group = "INSERT INTO group (groupName, permissionID) VALUES (NULL,'$groupName','$permID')";


      $group = "INSERT INTO `group` (`groupID` ,`groupName` ,`permissionID`)VALUES (NULL,  '$groupName',  '$permissionID')";
      $group_insert = mysqli_query($db, $group) or die(mysqli_error($db));
      if ($group_insert) {
          echo "Thank You! Group Successfully Added";
      } else {
          echo "Group registration failed";

      }
  }

}


?>
<head>
    <style type="text/css">
        .auto-style1 {
            width: 100%;
        }
        .auto-style2 {
            text-align: right;
        }
    </style>
</head>
  <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
    <table border="1">
        <tr>
            <td>Group Name</td>
            <td>Permission Name</td>
        </tr>
        <tr>

            <td><input type="text" name="groupName" maxlength="60"></td>
            <td>
                <select name="permissionID">
                    <option value="" selected>Permissions Level</option>
                    <?php
                    //Select all countries from table as a dropdown
                    while ($rowCerts = $permissions_dropdown->fetch_assoc()) {
                        echo html_entity_decode("<option value=\"{$rowCerts['permissionID']}\">");
                        echo html_entity_decode($rowCerts['permissionName']);
                        echo "</option>";
                    }
                    ?>

                </select>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <table>
                    <tr>
                        
                    </tr>
                </table>
                <table class="auto-style1">
                    <tr>
                        <td class="auto-style2">
                            <input name="group_submit" type="submit" value="Add Group" /> </td>
                        <td class="auto-style2">&nbsp;</td>
                        <td>
                            <input type="reset" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </form>