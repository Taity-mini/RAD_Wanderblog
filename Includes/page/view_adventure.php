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
//session_start(); //comment out for now - session already started in index.php
if(isset($_GET['id']))
{

    //$getid = $_GET['id'];
    $getid = htmlentities($_GET['id']);
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
    $current_user = $_SESSION["userID"]; //Current user logged in - differs from $userID which is adventure author!

       /*Voting Functions START*/
     $vote = mysqli_query($db,"SELECT SUM(vote_Count), userID, pageID FROM `votes` WHERE pageID = '$pageID'");
     $vote_count = 0;
     if(mysqli_num_rows($vote) > 0)
     {
        $vote_info = mysqli_fetch_array($vote) or die(mysqli_error($db));
        $vote_count = $vote_info['SUM(vote_Count)'];

     }


     //if user votes up

     if (isset($_POST['vote_up'])) {

        echo"Vote up pressed!";
        $voting_up = "INSERT INTO `votes` (`userID` ,`pageID` ,`vote_Count`)VALUES ('$current_user', '$pageID', '1')";
        $vote_insert = mysqli_query($db, $voting_up) or die(mysqli_error($db));
        if($vote_insert)
        {
            $view_adventure = $_SERVER['REQUEST_URI'];
            header("Refresh: 1; URL=\"" . $view_adventure . "\"");
            echo "<script> alert('Voted up Successfully - Good one!');</script>";
        }
        else
        {

            $view_adventure = $_SERVER['REQUEST_URI'];
            header("Refresh: 1; URL=\"" . $view_adventure . "\"");
            echo "<script> alert('Vote up Unsuccessful');</script>";
        }

        //unset($_POST);

     }


     //if user votes down
      if (isset($_POST['vote_down'])) {
        echo"Vote down pressed!";
        $voting_down = "INSERT INTO `votes` (`userID` ,`pageID` ,`vote_Count`)VALUES ('$current_user', '$pageID', '-1')";
        $vote_insert = mysqli_query($db, $voting_down) or die(mysqli_error($db));
         if($vote_insert)
        {

            $view_adventure = $_SERVER['REQUEST_URI'];
            header("Refresh: 2; URL=\"" . $view_adventure . "\"");
            echo "<script> alert('Voted down- Thats a shame..');</script>";
        }
        else
        {
            echo "<script> alert('Voted down- Unsuccessful');</script>";
            $view_adventure = $_SERVER['REQUEST_URI'];
            header("Refresh: 2; URL=\"" . $view_adventure . "\"");

        }
     }

     /*Voting Functions END*/


    //Picture Variables
     $pictures = mysqli_query($db,"SELECT * FROM `picture_gallery_pages` WHERE PageID = '$pageID'") or die(mysqli_error($db));
    //$pictures_info = mysqli_fetch_array($pictures) or die(mysqli_error($db));

    //Comment Variables

      if(isset($_POST['commentText']))
      {
        $comment = $_POST['commentText'];
      }

    //$userId = $_SESSION['userID']; Use $current_user instead ^_^

    if(isset($_POST['addCommentBtn'])){

       $insert = "INSERT INTO comments (comment, userID, pageID) VALUES ('$comment', '$current_user', '$getid')";
       $result = mysqli_query($db, $insert);
       header('Location: '.$_SERVER['REQUEST_URI']); //this should now refresh correctly :)

    }




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
                     <?php
                    //If user hasn't voted yet then display form
                    if (!hasUserVoted($db, $current_user, $pageID))
                    {
                    ?>
                  <form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="post" style="text-align: center">
                    <table class="auto-style1">
                        <tr>
                            <td class="auto-style2">
                            <input type="submit" name="vote_up" alt="Vote UP" value="UP"/></td>
                        </tr>
                        <tr>
                            <td class="auto-style2">Vote(s)[<?php echo $vote_count ?>]</td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="vote_down" alt="Vote Down" value="DOWN"/</td>
                        </tr>
                    </table>
                    </form>
                     <?php
                     }
                     //Otherwise just show vote counter
                    else
                     {
                     echo "Vote(s)[$vote_count]";
                     }
                    ?>
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








<div id = "Adventure-Profile-Content-0">
    <?php
    while($images1 = mysqli_fetch_array($pictures))){
    echo '<div id = "Small-Img">';
    echo "<img src='".$images1['filePath']."' />";
    echo '</div>';
    }
    ?>	
</div>






















</br>


<!--Comment codes Goes here!-->
<h2>Trip Comments</h2>
<br/>
<table border="1" align = "Center">
<tr>
<form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="post" style="text-align: center">
    <td>Add Comment</td>
    <td><textarea rows="4" cols="50" name = "commentText" id = "commentText">
    Add your Comment
    </textarea>
    <input type = "submit" name = "addCommentBtn" id = "addCommentBtn"/><br /></td>
</form>
</tr>
</table>
<table border="1" align = "Center" >

    <tr>
        <td>User</td>
        <td>Comment</td>
    </tr>

    <?php

    $query = "SELECT * FROM comments WHERE pageID = '$getid'";
    $result1 = mysqli_query($db, $query);

    while($row = mysqli_fetch_assoc($result1)){

    $username = $row['userID'];

    $query1 = "SELECT userName FROM users where userID = '$username'";
    $result2 = mysqli_query($db, $query1);

    $row1 = mysqli_fetch_assoc($result2);
     echo '<tr>';
     echo '<td>'. strip_tags($row1['userName']) .'</td>';
     echo '<td>'. strip_tags($row['comment']) .'</td>';
     echo '</tr>';


    }


    ?>
</table>
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
	
<?php
    $queryPages = "SELECT * FROM pages";
    $resultPages = mysqli_query($db, $queryPages);
    while($rowPages = mysqli_fetch_assoc($resultPages)){
        
    $pagePic = $rowPages['PageID'];
    $picOne = mysqli_query($db, "SELECT * FROM picture_gallery_pages WHERE pageID = '$pagePic'");
    $picAdventure = mysqli_fetch_array($picOne);

    echo    '<div id = "content-blob">';
    echo       '<div class = "Picture_Container">';
    echo           '<a href="./?page=adventure&id=' . $rowPages['PageID'] . '"> <img src="'.$picAdventure['filePath'].'"/></a>';
    echo       '</div>';
    echo       '<div class = "Text_Container">'. $rowPages['bio'] .'</div>';
    echo    '</div>';

    }
?>
        
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
