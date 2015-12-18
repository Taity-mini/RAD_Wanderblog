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
                        echo "<script> alert('Group Deleted Successfully');</script>";
                        $page = "./?page=admin";
                        header("Refresh: 2; URL=\"" . $page . "\"");
                    }

                } else
                {
                    echo "<script> alert('Delete Group Failed');</script>";
                    $page = "./?page=admin";
                    header("Refresh: 2; URL=\"" . $page . "\"");
                }
            break;

        case "perm":

                $perm_check = permissionInUse($db, $getid, "Check");
                echo $perm_check;

                if($perm_check)
                {
                    $delete_perm = mysqli_query($db,"DELETE FROM `group_permissions` WHERE permissionID = '$getid'");

                    if($delete_perm)
                    {
                        $msg = "Delete group permissions successful";
                        echo "<script> alert('Group Added Successfully');</script>";
                        $page = "./?page=admin";
                        header("Refresh: 2; URL=\"" . $page . "\"");
                    }

                } else
                {
                    echo "<script> alert('Delete Permission Failed');</script>";
                    $page = "./?page=admin";
                    header("Refresh: 2; URL=\"" . $page . "\"");
                }
            break;
        //If user gets deleted so does all their content.
        case "user":

                $delete_user = mysqli_query($db,"DELETE FROM `user` WHERE userID = '$getid'");
                $delete_user_pages = mysqli_query($db,"DELETE FROM `pages` WHERE userID = '$getid'");
                $delete_user_comments = mysqli_query($db,"DELETE FROM `comments` WHERE userID = '$getid'");
                $delete_user_votes = mysqli_query($db,"DELETE FROM `votes` WHERE userID = '$getid'");
                $delete_user_pictures = mysqli_query($db,"DELETE FROM `picture_gallery_users` WHERE userID = '$getid'");



                    echo "<script> alert('User Deleted Successfully');</script>";
                    $page = "./?page=admin";
                    header("Refresh: 2; URL=\"" . $page . "\"");

            break;


        case "page":


            $delete_page = mysqli_query($db,"DELETE FROM `pages` WHERE PageID = '$getid'");
            $delete_page_comments = mysqli_query($db,"DELETE FROM `comments` WHERE pageID = '$getid'");
            $delete_pages_votes = mysqli_query($db,"DELETE FROM `votes` WHERE pageID = '$getid'");
            $delete_pages_pictures = mysqli_query($db,"DELETE FROM `picture_gallery_pages` WHERE pageID = '$getid'");


            $msg = "Delete group permissions successful";
            echo "<script> alert('Group Added Successfully');</script>";
            $page = "./?page=admin";
            header("Refresh: 2; URL=\"" . $page . "\"");

            break;

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
