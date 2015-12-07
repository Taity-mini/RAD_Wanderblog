<?php
/*
 * Created by PhpStorm.
 * User: RAD
 * Date: 26/11/2015
 * Time: 16:40
 * Description: Main index page for WanderBlog
 */

//include("includes/connect.php");


//$listdbtables = array_column(mysqli_fetch_all($db->query('SHOW TABLES')),0);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Wanderblog | Home Page</title>
    <link rel="stylesheet" href="./style.css" />
</head>
<body>
<div id="Wrapper">
    <div id="Header">
        <p>Header image goes here!</p>
        <div class ="nav">
            <ul>
                <li class ="Home"><a>Home</a></li>
                <li class ="Login"><a>Login</a></li>
                <li class ="Register"><a>Register</a></li>
            </ul>
        </div>
    </div>
    <div id ="Content">
        <h1>Header</h1>
        <div id ="Content-inner">


            <p>Hello</p<br />
            <br />
            <ol>
                <li></li>
                <li></li>
                <li>&nbsp;&nbsp;</li>
            </ol>
            <br />
        </div>
        <br />
    </div>
</div>

    <div id ="Footer">
        <p>Footer</p>
    </div>
</body>
</html>