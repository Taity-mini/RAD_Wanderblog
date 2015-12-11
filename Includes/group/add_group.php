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
<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 09/12/2015
 * Time: 22:11
 */

if (isset($_POST["submit"]))
{
    //Grab Data from field
    $fields = array('groupName','permissionName',
                    'createContent', 'createComment', 'vote', 'editVote', 'editContent', 'editComment', 'viewContent', 'viewComment');
    $data = array();
    foreach ($fields AS $fieldname) { //Loop trough each field
        $fieldname = $_POST[$fieldname]; //grab from form
        echo $fieldname;
        $fieldname = mysqli_real_escape_string($db, $fieldname); //prevent from SQL injection
        $data[] = $fieldname;
    }

    //set variables from array data
    $groupName = $data[0];
    $permissionName = $data[1];
    $createContent = $data[2];
    $createComment = $data[3];
    $vote = $data[4];
    $editVote = $data[5];
    $editContent = $data[6];
    $editComment = $data[7];
    $viewContent = $data[8];
    $viewComment = $data[9];

    //Insertion Queries


    //permissions first
    $permissions = "INSERT INTO group_permissions (permissionName,create_Content, create_Comments, vote, edit_Vote_Admin, edit_Content, edit_Comments, view_Content, view_Comments)
                                           VALUES ('$permissionName','$createContent', '$createComment' , '$vote',  '$editVote', '$editContent' ,'$editComment', '$viewContent', $viewComment)";

    $permissions_insert = mysqli_query($db, $permissions) or die(mysqli_error($db));


    //grab permission ID from permissions table
    if ($permissions_insert)
    {
        $permID =$db->query("SELECT permissionID FROM group_permissions WHERE permissionName = '$permissionName' limit 1")->fetch_object()->permissionID;
        echo $permID;
    }
    else
    {
        echo"Permission Insert failed";
    }

    echo $permID;
    //Finally add group



    //$group = "INSERT INTO group (groupName, permissionID) VALUES (NULL,'$groupName','$permID')";


    $group = "INSERT INTO `group` (`groupID` ,`groupName` ,`permissionID`)VALUES (NULL,  '$groupName',  '$permID')";
    $group_insert = mysqli_query($db,$group) or die(mysqli_error($db));
    if ($group_insert) {
        echo "Thank You! Group Successfully Added";
    }
    else{
        echo "Group registration failed";

    }


}


?>
  <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
    <table border="1">
        <tr>
            <td>Group Name</td>
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
            <td><input type="text" name="groupName" maxlength="60"></td>
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
                            <input name="submit" type="submit" value="Register" /> </td>
                        <td class="auto-style2">&nbsp;</td>
                        <td>
                            <input type="reset" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </form>