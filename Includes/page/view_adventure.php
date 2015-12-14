<?php
/**
 * Created by PhpStorm.
 * User: RAD
 * Date: 08/12/2015
 * Time: 11:53
 */


if(isset($_GET['id']))
{
    $getid = $_GET['id'];
    $error = false;

    //Individual Adventures
    $page = mysqli_query($db,"SELECT * FROM `pages` WHERE pageID = '$getid'");
    $info = mysqli_fetch_array($page) or die;

    //Page Variables
    $content_header = $info['title'];
    $trip_Date =date('d/m/Y',strtotime($row['trip_Date']));
    $mod_date =date('d/m/Y',strtotime($row['mod_Date']));

    //User Variables
    $userID = $info['userID'];
    $user = mysqli_query($db,"SELECT * FROM `users` WHERE userID = '$userID'");
    $user_info = mysqli_fetch_array($page) or die;


    //Picture Variables



    //Comment Variables




//If there is an adventure then display it
    if (mysqli_num_rows($info) > 0)
    {
       ?>

        <h1><?php echo $content_header ?></h1>
        <div id ="Content-inner">

        </div>
        <table border="1">
            <tr>
                <td>
                    Author:</td>
                <td>
                    <?php echo $user_info['userName']; ?> </td>
            </tr>
            <tr>
                <td>
                    Trip Country</td>
                <td>
                    <?php echo countryName($db,$info['trip_country']) ?>  </td>
            </tr>
            <tr>
                <td>
                    Instructor:</td>
                <td>
                    <?php echo $overview['Instructor'];?></td>
            </tr>
            <tr>
                <td>
                    Sessions per week</td>
                <td>
                    <?php echo $overview['Sessions_week'];?> </td>
            </tr>
            <tr>
                <td>
                    Short-term goal</td>
                <td>
                    <?php echo $overview['Goal'];?> </td>
            </tr>
            <tr>
                <td>
                    Start Date:</td>
                <td>
                    <?php echo $start_date ;?> </td>
            </tr>
        </table>


<?php

    }
    else
    {
        echo "Invalid Adventure ID";
    }

}
//If no &id= is provided then display all adventures
else
{

//Main Page
    $listAdventures = mysqli_query($db,"SELECT * FROM `pages`");
    $rows = mysqli_fetch_array($listAdventures) or die;
?>

<!--<head>

<title>
	Home
</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>-->

<div id = "Inner_Wrap">
<h1><?php echo $content_header ?></h1>
<h2> </h2>

<div id ="Content-inner">


	<div id = "columns">
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>



                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

<div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>



                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        


        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp4.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>



                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        


        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp1.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp4.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>



                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

<div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>



                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        


        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp4.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>



                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        


        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp1.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp4.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>



                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

<div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>



                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        


        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp4.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>



                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        


        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp1.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp4.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>



                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        


        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp4.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>



                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>
<<<<<<< Updated upstream

        


        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp1.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        
        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

=======
>>>>>>> Stashed changes

                <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp4.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

<<<<<<< Updated upstream


                        <div id = "content-blob">
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>


                        <div id = "content-blob">
           <div class = "Picture_Container">
           		<img src="./Res/temp3.jpg" >
           </div>
           <div class = "Text_Container">
           Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb Rubarb 
           </div>
        </div>

        



</div>
</div>
</div>
<br />
</body>
</html>
=======
</div>
</div>
<br />
    <?php
}
?>
>>>>>>> Stashed changes
