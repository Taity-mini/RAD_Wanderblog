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
$msg ="";
if (isset($type)) {
    switch ($type) {

        case "group":
            function delete_group($getid, $db)
            {
                $group_check = groupInUse($db, $getid, "Check");

                $msg = "delete record";
                if ($group_check) {

                } else {

                }

            }
            break;

        case "perm":
            function delete_permissions($getid)
            {
                //
            }

            break;
        case "user":
            function delete_permissions($getid)
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
<?php
echo $msg;
?>
</div>
