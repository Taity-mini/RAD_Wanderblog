<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (150463)
 * Date: 12/12/2015
 * Time: 14:24
 * Edit Group (Admin)
 */

$getid = htmlentities($_GET['id']);
$error = false;

$result = mysqli_query($db, "SELECT * FROM `group` WHERE groupID = '$getid'");
$info = mysqli_fetch_array($result) or die;

//Permissions Dropdown for group creation
$queryPermissions = "SELECT permissionID, permissionName FROM group_permissions";
$permissions_dropdown = $db->query($queryPermissions);

if (isset($_POST['update'])) {
//Grab Data from field
    $fields = array('groupName', 'permissionID');
    $data = array();
    foreach ($fields AS $fieldname) { //Loop trough each field
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
            echo 'Field ' . $fieldname . ' misses!<br />'; //Display error with field
            $error = true; //Yup there are errors
        } else {
            $fieldname = $_POST[$fieldname]; //grab from form
            echo $fieldname;
            $fieldname = mysqli_real_escape_string($db, $fieldname); //prevent from SQL injection
            $data[] = $fieldname;
        }
    }
    if (!$error) {

        //set variables from array data
        $groupName = $data[0];
        $permissionID = $data[1];
        $id = $info['groupID'];

        //update group
        $update_group = mysqli_query($db, ("UPDATE `group` SET `groupName` = '$groupName', `permissionID`='$permissionID'  WHERE groupID = '$id'"));
        if ($update_group) {
            echo "Group successfully updated!";
            $page = "./?page=admin";
            header("Refresh: 2; URL=\"" . $page . "\"");
        } else {
            echo("<br>Input data is fail");
        }

    }
}

?>
<h1><?php echo $content_header . "ID :" . $getid ?></h1>
<div id="Content-inner">
    <form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="post" style="text-align: center">
        <table border="1" align="center">
            <tr>
                <td>Group ID</td>
                <td><?php echo $info['groupID']; ?></td>
            </tr>
            <tr>
                <td>Group Name</td>
                <td><input type="text" name="groupName" maxlength="60" value="<?php echo $info['groupName']; ?>"style="width: 200px"></td>
            </tr>
            <tr>
                <td>Permission Level</td>
                <td>
                    <select name="permissionID">
                        <?php
                        //Select all permissions from table as a dropdown

                        while ($rowCerts = $permissions_dropdown->fetch_assoc()) {
                            $selected = ($info['permissionID'] == $rowCerts['permissionID']) ? 'selected="selected"' : '';
                            echo '<option ' . $selected . ' value="' . $rowCerts['permissionID'] . '">' .
                                $rowCerts['permissionName'] . '</option>';

                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input name="update" style="text-align: center" type="submit" value="Update Group"/></td>
                <td><input type="reset" value="Reset"/></td>
            </tr>
        </table>
    </form>
</div>