<?php
/*
 * Created by PhpStorm.
 * User: RAD
 * Date: 26/11/2015
 * Time: 16:40
 * Description: Main index page for WanderBlog
 */

include("./includes/connect.php");
include("./includes/global.php")

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
                <li class ="Home"><a href ="./">Home</a></li>
                <li class ="Login"><a href="./?page=login">Login</a></li>
                <li class ="Register"><a href ="./?page=register">Register</a></li>
                <li class="news"><a href="#">Adventure</a>
                    <ul>
                        <li><a href="#">Author Search</a></li>
                        <li><a href="#">News #3</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div id ="Content">
        <?php
        //$page = (isset($_GET['page']) ? $_GET['page'] : 'home') . '.php';
       // $page = $_GET['page'];
        if(isset($_GET['page'])) {
            switch ($_GET['page']) {

                case "login":
                    $content_header = "Login";
                    include("./login.php");
                    break;

                case "register":
                    $content_header = "Register";
                    include("./register.php");
                    break;

            }
        }
        else{
            $content_header = "Welcome";
            include("./welcome.php");
        }
        ?>
</div>
</div>

    <div id ="Footer">
        <p>© <?php echo date("Y");?> RAD | <a href ="https://github.com/Taity-mini/RAD_Wanderblog" >Github Repo</a> </p>
    </div>
</body>
</html>