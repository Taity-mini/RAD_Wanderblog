<?php
/*
 * Created by PhpStorm.
 * User: RAD
 * Date: 26/11/2015
 * Time: 16:40
 * Description: Main index page for WanderBlog
 */

session_start();

include("./includes/connect.php");
include("./includes/global.php");
include("./includes/functions.php");

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Wanderblog | Home Page</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="./Java/jquery-ui.css" />
    <script  src = "java/jquery.min.js"</script>
    <script  src = "java/jquery-ui.js"></script>
    <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
    <script  src = "java/popup.js"></script>
    <script  src = "java/functions.js"></script>
<!--  Tweets Node Js  -->
</head>
<body>

    <div id="Header">
        <div id = "Header_Image"><img src="./Res/temp.jpg" alt="Coffee Shop" ></div>
        </div>
        <div class ="nav">
            <ul>
                <li class ="Home"><a href ="./">Home</a></li>
                <?php

                if(empty($_SESSION['username'])){

                ?>

                <li><a href="javascript:void(0)" onclick="toggle_visibility('popupBoxTwoPosition');" id = "login">Login</a></li>
                <li class ="Register"><a href ="./?page=register">Register</a></li>

                <?php }

                else{

                ?>
                <li><a href="logout.php" tite="Logout" id = "logoutBtn">Log Out</a></li>

                <?php } ?>

                <li class="Adventure"><a href="./?page=adventure">Adventure</a>
                    <ul>
                        <li><a href="./?page=add_adventure">Add Adventure</a></li>
                        <li><a href="./?page=edit_adventure">Edit Adventure</a></li>
                        <li><a href="./?page=search_adventure">Search Adventure</a></li>
                    </ul>
                </li>

                <?php
                //Check if session is not empty then check if they are an admin
                if (isset($_SESSION['groupID'])  && $_SESSION['groupID'] != null ){

                    if(isAdmin($db,$_SESSION['groupID'])){
                ?>
                    <li class="Admin"><a href="#">Admin</a>
                        <ul>
                           <li><a href="./?page=admin">Admin Panel</a></li>
                         <li><a href="#">User Management</a></li>
                        </ul>
                    </li>
                <?php
                     }}
                ?>
                <li class="Search"><a href="#">Search</a>
                    <ul>
                        <li><a href="./?page=search_adventure">Search Adventure</a></li>
                        <li><a href="./?page=search_user">Search Adventure</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div id="Wrapper">
            <div id ="Content">
        <?php
        //$page = (isset($_GET['page']) ? $_GET['page'] : 'home') . '.php';
       // $page = $_GET['page'];
        if(isset($_GET['page'])) {
            switch ($_GET['page']) {

             //Main Pages
                case "register":
                    $content_header = "Register";
                    include("./register.php");
                    break;

                case "admin":
                    $content_header = "Admin Panel";
                    include("./admin.php");
                    break;

                //Adventure Pages
                 case "add_adventure":
                    $content_header = "Add Adventure";
                    include("./Includes/page/add_adventure.php");
                    break;

                case "adventure":
                    $content_header = "Adventure";
                    include("./Includes/page/view_adventure.php");
                    break;

                //User profile
                    case "view_user":
                    $content_header = "User Profile";
                    include("./Includes/user/view_user.php");
                    break;

                //Editing forms

                case "edit_user":
                    $content_header = "Edit User";
                    include("./Includes/user/edit_user.php");
                    break;

                case "edit_group":
                    $content_header = "Edit Group";
                    include("./Includes/group/edit_group.php");
                    break;

                case "edit_perm":
                    $content_header = "Edit Permission";
                    include("./Includes/group/edit_permission.php");
                    break;

                case "edit_adventure":
                    $content_header = "Edit Adventure";
                    include("./Includes/page/edit_adventure.php");
                    break;



                //Delete Functions
                    case "delete":
                    $content_header = "Delete Record";
                    include("./Includes/delete.php");
                    break;

                //Search Functions

                case "search_adventure":
                    $content_header = "Search Adventure";
                    include("./Includes/page/search_adventure.php");
                    break;

                case "search_adventure":
                    $content_header = "Search Author";
                    include("./Includes/user/search_user.php");
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
<div id = "Welcome_Outter_Wrap">
<h1>Trending</h1>
<h2> </h2>
    <div id = "Content-outter">
    <div class = "Trending_Picture_Container"><header><h4>Votes</h4></header></div>
    <div class = "Trending_Picture_Container"><header><h4>Votes</h4></header></div>
    </div>

</div>
</body>
    <div id ="Footer">
        <p>© <?php echo date("Y");?> RAD | <a href ="https://github.com/Taity-mini/RAD_Wanderblog" >Github Repo</a> </p>
    </div>
    <div id="popupBoxTwoPosition">
        <div class="popupBoxTwoWrapper">
            <div class="popupBoxContent">
                    <form id = "LoginForm" action = "login.php" method = "post">
                        <input id = "username" type = "text" name = "username" placeholder = "Username"><br />
                        <input id = "password" type = "password" name = "password"  placeholder = "Password"><br />
                        <a href ="./?page=register" id = "regPage" >Register</a>
                        <input type = "submit" name = "loginSubmit" id = "loginSubmit"/><br />
                        <input type = "button" name = "button" href="javascript:void(0)" onclick="toggle_visibility('popupBoxTwoPosition');" id = "CloseButton" value ="Close">
                        <div id = "d1" style="color: red"></div>
                    </form>
            </div>
        </div>
    </div>    
</div>
</body>
</html>