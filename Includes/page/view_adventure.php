<head>
    <style type="text/css">
        .auto-style1 {
            width: 100%;
        }
        .auto-style2 {
            text-align: center;
        }
    </style>
</head>
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
    $page = mysqli_query($db,"SELECT * FROM `pages` WHERE PageID = '$getid'");
    $info = mysqli_fetch_array($page)  or die(mysqli_error($db));
    $pageID = $info['PageID'];


    //Page Variables
    $content_header = $info['title'];
    $trip_Date =date('d/m/Y',strtotime($info['trip_Date']));
    $mod_date =date('d/m/Y',strtotime($info['mod_Date']));

    //User Variables
    $userID = $info['userID'];
    $user = mysqli_query($db,"SELECT * FROM `users` WHERE userID = '$userID'");
    $user_info = mysqli_fetch_array($user) or die(mysqli_error($db));

    //Voting Variables
     $vote = mysqli_query($db,"SELECT * FROM `vote` WHERE pageID = '$pageID'");

    //Picture Variables
     $pictures = mysqli_query($db,"SELECT * FROM `picture_gallery_pages` WHERE PageID = '$pageID'") or die(mysqli_error($db));
    //$pictures_info = mysqli_fetch_array($pictures) or die(mysqli_error($db));

    //Comment Variables




//If there is an adventure then display it
    if (mysqli_num_rows($page) > 0)
    {
       ?>

  <script>
        window.onload = function() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {

                    var tweets = JSON.parse(xhttp.responseText);
                    var tweetstring = "";
                        //Limit tweets by 5 and display in list
                        for (var i =0; i< 5 ; i++)
                        {
                            tweetstring += "<li><b>" + tweets[i].name + "</b>";
                            tweetstring += "<ul><li>" + tweets[i].text + "</li></ul></li>";
                        }

                    document.getElementById("twitter").innerHTML = tweetstring;
                }
            };
            xhttp.open("GET", "http://rgunodeapp.azurewebsites.net/?q=<?php echo $info['tags'];?>", true);
            xhttp.send();
        }
    </script>

        <h1><?php echo $content_header ?></h1>
        <div id ="Content-inner">

        <table border="1" align = "Center">
            <tr>
                <td>
                    Author:</td>
                <td>
                    <?php echo $user_info['userName']; ?> </td>
            </tr>
            <tr>
                <td>
                    Trip Country</td>

                    <?php echo countryName($db,$info['trip_country']);?>
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
                    Votes:</td>
                <td>
                    <table class="auto-style1">
                        <tr>
                            <td class="auto-style2">
                            <input type="submit" name="vote_up" alt="Vote UP" value="UP"/></td>
                        </tr>
                        <tr>
                            <td class="auto-style2">Vote[]</td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="vote_down" alt="Vote Down" value="DOWN"/</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

            <br />
 <h2>Tweets(based on trip tag)</h2>
            <ul id ="twitter">
            </ul>
<!--Picture codes Goes here-->
<br/>
<h2>Trip Pictures</h2>
<?php

if (mysqli_num_rows($pictures) > 0)
{
    print "<table border='1' cellspacing='0'>";
     while($images = mysqli_fetch_array($pictures))
      {
        echo "<trstyle='background-color:#000000;'>";
        echo "<td>";
        echo "<img src='".$images['filePath']."' /></br>";
        echo "<p>" .$images['photoDesc']. "</p>";
        echo "</td>";
      }
     echo"</table>";
    }
else
{   //No picture Display message
    echo"No Pictures currently available for this trip";
}

 ?>
</br>


<!--Comment codes Goes here!-->
<h2>Trip Comments</h2>
<br/>
<!--Comment codes Goes here!-->



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

