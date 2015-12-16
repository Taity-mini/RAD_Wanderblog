<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (1504693)
 * Date: 11/12/2015
 * Time: 12:59
 * Insert Permissions into Database
 */
$error = false;
if (isset($_POST["permission_submit"]))
{
    //Grab Data from field
    $fields = array('permissionName',
        'createContent', 'createComment', 'vote', 'editVote', 'editContent', 'editComment', 'viewContent', 'viewComment');
    $data = array();

    if (!isset($_POST['permissionName']) || empty($_POST['permissionName'])) {
        echo 'Field Permission Name misses!<br />'; //Display error with field
        $error = true; //Yup there are errors
    }

if (!$error)
{

    foreach ($fields AS $fieldname) { //Loop trough each field
        $fieldname = $_POST[$fieldname]; //grab from form
        echo $fieldname;
        $fieldname = mysqli_real_escape_string($db, $fieldname); //prevent from SQL injection
        $data[] = $fieldname;
    }

    //set variables from array data

    $permissionName = $data[0];
    $createContent = $data[1];
    $createComment = $data[2];
    $vote = $data[3];
    $editVote = $data[4];
    $editContent = $data[5];
    $editComment = $data[6];
    $viewContent = $data[7];
    $viewComment = $data[8];

    //Insertion Queries


    //permissions first
    $permissions = "INSERT INTO group_permissions (permissionName,create_Content, create_Comments, vote, edit_Vote_Admin, edit_Content, edit_Comments, view_Content, view_Comments)
                                           VALUES ('$permissionName','$createContent', '$createComment' , '$vote',  '$editVote', '$editContent' ,'$editComment', '$viewContent', $viewComment)";

    $permissions_insert = mysqli_query($db, $permissions) or die(mysqli_error($db));


    //grab permission ID from permissions table
    if ($permissions_insert)
    {
        echo "<script> alert('Permission Added Successfully');</script>";
        $admin_panel = $_SERVER['REQUEST_URI'];
        header("Refresh: 2; URL=\"" . $admin_panel . "\"");

    }
    else
    {
        header("Refresh: 2; URL=\"" . $admin_panel . "\"");
        echo "<script> alert('Permission Insert failed\"');</script>";
        $admin_panel = $_SERVER['REQUEST_URI'];

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
            <td>Permission Name</td>
            <td>Create Content</td>
            <td>Create Comments</td>
            <td>Vote</td>
            <td>Edit Vote (Admin)</td>
            <td>Edit Content</td>
            <td>Edit Comments</td>
            <td>View Content</td>
            <td>View Comments</td>
        </tr>
        <tr>
            <input type="hidden" name="createContent" value="0" />
            <input type="hidden" name="createComment" value="0" />
            <input type="hidden" name="vote" value="0" />
            <input type="hidden" name="editVote" value="0" />
            <input type="hidden" name="editContent" value="0" />
            <input type="hidden" name="editComment" value="0" />
            <input type="hidden" name="viewContent" value="0" />
            <input type="hidden" name="viewComment" value="0" />
            <td><input type="text" name="permissionName" maxlength="60"></td>
            <td><input type="checkbox" name="createContent" value="1" /></td>
            <td><input type="checkbox" name="createComment" value="1" /></td>
            <td><input type="checkbox" name="vote" value="1" /></td>
            <td><input type="checkbox" name="editVote" value="1" /></td>
            <td><input type="checkbox" name="editContent" value="1" /></td>
            <td><input type="checkbox" name="editComment" value="1" /></td>
            <td><input type="checkbox" name="viewContent" value="1" /></td>
            <td><input type="checkbox" name="viewComment" value="1" /></td>
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
                            <input name="permission_submit" type="submit" value="Add Permission" /> </td>
                        <td class="auto-style2">&nbsp;</td>
                        <td>
                            <input type="reset" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>