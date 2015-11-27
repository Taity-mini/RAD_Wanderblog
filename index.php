<?php
/*
 * Created by PhpStorm.
 * User: RAD
 * Date: 26/11/2015
 * Time: 16:40
 * Description: Main index page for WanderBlog
 */

include("connect.php");

echo "Home Page";

$result = mysql_query("show tables"); // run the query and assign the result to $result
while($table = mysql_fetch_array($result)) { // go through each row that was returned in $result
    echo($table[0] . "<BR>");    // print the table that was returned on that row.
}


?>