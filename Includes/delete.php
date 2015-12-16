<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (150463)
 * Date: 13/12/2015
 * Time: 22:10
 * Delete function for Permissions,Groups and Users
 */
$getid = htmlentities($_GET['id']);
$type = htmlentities($_GET['type']);
echo $type;
$msg ="";
if (isset($type)) {
    //echo "IT works here!";
    switch ($type) {
        case "group":
                $group_check = groupInUse($db, $getid, "Check");
                echo $group_check;

                if ($group_check)
                {
                    $delete_exercises = mysqli_query($db,"DELETE FROM `group` WHERE groupID = '$getid'");

                    if($delete_exercises)
                    {
                        $msg = "Delete group successful";
                        echo "<script> alert('Group Added Successfully');</script>";
                        $page = "./?page=admin";
                        header("Refresh: 2; URL=\"" . $page . "\"");
                    }

                } else
                {
                    echo "<script> alert('Delete Failed Failed');</script>";
                    $page = "./?page=admin";
                    header("Refresh: 2; URL=\"" . $page . "\"");
                }
            break;

        case "perm":
            function delete_permissions($getid)
            {
                //
            }

            break;
        case "user":
            function delete_user($getid)
            {
                //

            }

    }
} else {
//    $page = "./?page=Add_card";
//    header("Location: ./?page=Add_card");

}


?>
<h1><?php echo $content_header ?></h1>
<div id ="Content-inner">
<h3><?php echo $msg;?></h3>
</div>
