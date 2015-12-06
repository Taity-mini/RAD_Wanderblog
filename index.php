<?php
/*
 * Created by PhpStorm.
 * User: RAD
 * Date: 26/11/2015
 * Time: 16:40
 * Description: Main index page for WanderBlog
 */

include("includes/connect.php");

echo "Home Page";

$listdbtables = array_column(mysqli_fetch_all($db->query('SHOW TABLES')),0);
?>


