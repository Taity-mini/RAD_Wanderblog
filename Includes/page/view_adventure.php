<?php
/**
 * Created by PhpStorm.
 * User: RAD
 * Date: 08/12/2015
 * Time: 11:53
 */

if(isset($_GET['id']))
{
    echo "IT works!";
    $getid = $_GET['id'];
    $error = false;

    //Individual Adventures
    $page = mysqli_query($db,"SELECT * FROM `pages` WHERE PageID = '$getid'");
    $info = mysqli_fetch_array($page)  or die(mysqli_error($db));


    //Page Variables
    $content_header = $info['title'];
    echo $content_header;
    $trip_Date =date('d/m/Y',strtotime($info['trip_Date']));
    $mod_date =date('d/m/Y',strtotime($info['mod_Date']));
 echo "IT works!";
    //User Variables
    $userID = $info['userID'];
    echo "User ID" + $userID;
    $user = mysqli_query($db,"SELECT * FROM `users` WHERE userID = '$userID'");
    $user_info = mysqli_fetch_array($user) or die(mysqli_error($db));

    //Picture Variables



    //Comment Variables




//If there is an adventure then display it
    if (mysqli_num_rows($page) > 0)
    {
    echo "IT works inside if sTATEMENTS!";
       ?>

        <h1><?php echo $content_header ?></h1>
        <div id ="Content-inner">

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
                    <?php echo countryName($db,$info['trip_country']);?>  </td>
            </tr>
            <tr>
                <td>
                    Tags</td>
                <td>
                    <?php echo $info['tags'];?></td>
            </tr>
            <tr>
                <td>
                    Trip Date</td>
                <td>
                    <?php echo $trip_Date;?> </td>
            </tr>
            <tr>
                <td>
                    Last Updated</td>
                <td>
                    <?php echo  $mod_date;?> </td>
            </tr>
            <tr>
                <td>
                    Start Date:</td>
                <td>
                    <?php echo $start_date ;?> </td>
            </tr>
        </table>
</div>

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
</div>
</div>
</div>
<br />
</body>
</html>
</div>
</div>
<br />
    <?php
}
?>

