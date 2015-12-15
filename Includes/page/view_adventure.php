<head>
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


    //Page Variables
    $content_header = $info['title'];
    $trip_Date =date('d/m/Y',strtotime($info['trip_Date']));
    $mod_date =date('d/m/Y',strtotime($info['mod_Date']));

    //User Variables
    $userID = $info['userID'];
    $user = mysqli_query($db,"SELECT * FROM `users` WHERE userID = '$userID'");
    $user_info = mysqli_fetch_array($user) or die(mysqli_error($db));

    //Picture Variables



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
                <td></td>
            </tr>
        </table>

            <br />
 <h2>Tweets</h2>
            <ul id ="twitter">
                <li>lol
                    <ul>
                        <li>&nbsp;lol<br />
                        </li>
                    </ul>
                </li>
            </ul>

<h2>Trip Pictures</h2>

<!--Picture codes Goes here-->
<br/>
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

