<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (150463)
 * Date: 12/12/2015
 * Time: 15:26
 * Edit Permissions (Admin)
 */

$getid = htmlentities($_GET['id']);
$error = false;

$result = mysqli_query($db,"SELECT * FROM `group_permissions` WHERE permissionID = '$getid'");
$info = mysqli_fetch_array($result) or die;

if (isset($_POST['update'])) {

//Grab Data from field
    $fields = array('permissionName',
        'create_Content', 'create_Comments', 'vote', 'edit_Vote_Admin', 'edit_Content', 'edit_Comments', 'view_Content', 'view_Comments');
    $data = array();

    if (!isset($_POST['permissionName']) || empty($_POST['permissionName'])) {
        echo 'Field Permission Name misses!<br />'; //Display error with field
        $error = true; //There are errors
    }

    if (!$error) {
        foreach ($fields AS $fieldname) { //Loop trough each field
            $fieldname = $_POST[$fieldname]; //grab from form
            //echo $fieldname;
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

        $id = $info['permissionID'];

        //update group
        $update_permission = mysqli_query($db, ("UPDATE `group_permissions` SET `permissionName` = '$permissionName', `create_Content`='$createContent',  `create_Comments`='$createComment',  `vote`='$vote',
                                                `edit_Vote_Admin`='$editVote', `edit_content`='$editContent', `edit_Comments`='$editComment',`view_Content`='$viewContent', `view_Comments`='$viewComment'
        WHERE permissionID = '$id'"));
        if ($update_permission) {
            echo "Group successfully updated!";
            $page = "./?page=admin";
            header("Refresh: 2; URL=\"" . $page . "\"");
        } else {
            echo("<br>Input data is fail");
        }
    }

}
?>

<h1><?php echo $content_header . " ID :" . $getid ?></h1>
<div id ="Content-inner">
    <form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="post" style="text-align: center">

        <input type="hidden" name="create_Content" value="0" />
        <input type="hidden" name="create_Comments" value="0" />
        <input type="hidden" name="vote" value="0" />
        <input type="hidden" name="edit_Vote_Admin" value="0" />
        <input type="hidden" name="edit_Content" value="0" />
        <input type="hidden" name="edit_Comments" value="0" />
        <input type="hidden" name="view_Content" value="0" />
        <input type="hidden" name="view_Comments" value="0" />
        <table border="1" align="center">

            <tr>
                <td>Permission ID</td>
                <td><?php echo $info['permissionID']; ?></td>
            </tr>
            <tr>
                <td>Permission Name</td>
                <td><input type="text" name="permissionName" maxlength="60" value="<?php echo $info['permissionName']; ?>"style="width: 200px"></td>
            </tr>
            <tr>
                <td>Create Content</td>
                <td><input type="checkbox" name="create_Content"  value="1" <?php echo ($info['create_Content']==1 ? 'checked' : '');?>></td>
            </tr>
            <tr>
                <td>Create Comments</td>
                <td><input type="checkbox" name="create_Comments"  value="1" <?php echo ($info['create_Comments']==1 ? 'checked' : '');?>></td>
            </tr>
            <tr>
                <td>Vote</td>
                <td><input type="checkbox" name="vote"  value="1" <?php echo ($info['vote']==1 ? 'checked' : '');?>></td>
            </tr>
            <tr>
                <td>Edit Vote Admin</td>
                <td><input type="checkbox" name="edit_Vote_Admin"  value="1" <?php echo ($info['edit_Vote_Admin']==1 ? 'checked' : '');?>></td>
            </tr>
            <tr>
                <td>Edit Content</td>
                <td><input type="checkbox" name="edit_Content"  value="1" <?php echo ($info['edit_Content']==1 ? 'checked' : '');?>></td>
            </tr>
            <tr>
                <td>Edit Comments</td>
                <td><input type="checkbox" name="edit_Comments"  value="1" <?php echo ($info['edit_Comments']==1 ? 'checked' : '');?>></td>
            </tr>
            <tr>
                <td>View Content</td>
                <td><input type="checkbox" name="view_Content"  value="1" <?php echo ($info['view_Content']==1 ? 'checked' : '');?>></td>
            </tr>
            <tr>
                <td>View Comments</td>
                <td><input type="checkbox" name="view_Comments"  value="1" <?php echo ($info['view_Comments']==1 ? 'checked' : '');?>></td>
            </tr>
            <tr>
                <td></td>
                <td><input name="update" style="text-align: center" type="submit" value="Update Permission"/>&nbsp; <input type="reset" value="Reset"/></td>
            </tr>
        </table>
    </form>
</div>