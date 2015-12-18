<?php
/**
 * Created by PhpStorm.
 * User: Andrew Tait (1504693)
 * Date: 17/12/2015
 * Time: 11:50
 * Edit Comments form
 */

$getid = htmlentities($_GET['id']);
$error = false;

$query = "SELECT * FROM comments WHERE commentID = '$getid'";
$result = mysqli_query($db, $query);

$info = mysqli_fetch_array($result) or die;

if (isset($_POST["update"])) {
    $fields = array('comment');

    foreach ($fields AS $fieldname) { //Loop trough each field
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
            echo 'Field ' . $fieldname . ' misses!<br />'; //Display error with field
            $error = true; //Yup there are errors
        }
    }
//If all fields are filled in then proceed
    if (!$error) {


        $data = array();
        foreach ($fields AS $fieldname) { //Loop trough each field
            $fieldname = $_POST[$fieldname]; //grab from form
            //echo $fieldname;
            $fieldname = mysqli_real_escape_string($db, $fieldname); //prevent from SQL injection
            $data[] = $fieldname;
        }


        $comment = $data[0];
        $id = $info['commentID'];
        echo "ID:" + $id;
        //UPDATE  `rgu_1504693`.`comments` SET  `comment` =  'Nice trip lad test
        //' WHERE  `comments`.`commentID` =131;

        $update_comment = mysqli_query($db, ("UPDATE `comments` SET `comment` = '$comment'  WHERE `commentID` = '$id'"));

        if ($update_comment) {
            echo "<script> alert('Adventure comment Updated Successfully');</script>";
            $pageID = $info['pageID'];
            $return = "./?page=adventure&id=".$pageID;
            header("Location:" .$return);
            //header("Refresh: 2; URL=\"" . $return . "\"");
        } else {
            echo "<script> alert('Adventure Comment Update Failed');</script>";
            $pageID = $info['pageID'];
            $return = "./?page=adventure&id=".$pageID;
            header("Refresh: 2; URL=\"" . $return . "\"");
        }


    }


}

?>
<h1><?php echo $content_header . "ID :" . $getid ?></h1>
<div id ="Content-inner">
    <form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="post" style="text-align: center">
        <td>Add Comment</td>
        <td><textarea rows="4" cols="50" name = "comment"><?php echo htmlentities($info['comment']);?></textarea>
            <input type = "submit" name = "update"><br /></td>
    </form>
</div>
