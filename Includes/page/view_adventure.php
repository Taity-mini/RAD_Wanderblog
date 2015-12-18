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
    $uID = $user_info['userID'];
    $current_user = $_SESSION["userID"]; //Current user logged in - differs from $userID which is adventure author!
       /*Voting Functions START*/
     $profilePic =  mysqli_query($db, "SELECT * FROM picture_gallery_users WHERE userID = '$uID'");
     $fetchProfilePic = mysqli_fetch_array($profilePic);
     $vote = mysqli_query($db,"SELECT SUM(vote_Count), userID, pageID FROM `votes` WHERE pageID = '$pageID'");
     $vote_count = 0;


     //Edit & Delete Adventure
           $edit = "";
    //Only registered users can edit
    if(!empty($_SESSION['username'])){
    echo isReader($db,$_SESSION['groupID']);
        if(!isReader($db,$_SESSION['groupID']))
        {
            if($current_user == $userID){
              $edit = '<a href="./?page=edit_adventure&id='. $pageID .'">[Edit]</a>';
              $delete = '<a href ="#" onclick="deletePage('.$pageID.')"> [Delete]</a>';
            }

        }
    }



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

        <h1>Trip <?php echo $edit . $delete?></h1>
        <h2></h2>
        <div id ="Content-inner">

        <div id= "Profile-Content">
        

        <div id = "Profile-Horizontal-Split-Right">

        <div id = "Profile-Horizontal-Split-Left">
        <?php
    	echo '<div id ="Profile-Picture"><img src='.$fetchProfilePic['filePath'].'></div>';
    	?>
        <div id ="Profile-bio">
        <h3><?php echo $user_info['first_Name']. " ". $user_info['last_Name']; ?></h3>
        <h2></h2>
        Trip Country:<br/><?php echo countryName($db,$info['trip_country']);?><br/>
        Tags:<br/><?php echo $info['tags'];?><br/>
        Trip Date:<br/><?php echo $trip_Date;?><br/>
        Last Update:<br/><?php echo  $mod_date;?> <br/>
        
         <?php
                    //If user hasn't voted yet then display form
                    if(!empty($_SESSION['username'])){
                    if (!hasUserVoted($db, $current_user, $pageID) or isAdmin($db,$_SESSION['groupID']))
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
                     else
                     {
                         echo "Vote(s)[$vote_count]";
                     }
                     }
                     //Otherwise just show vote counter
                    elseif((empty($_SESSION['username']))){
                     echo "Vote(s)[$vote_count]";
                    }
                    ?>


        </div>
        </div>


        <div id ="Information-Header"><h1><?php echo $info['title'];?></h1><h2> </h2></div>
        <div id ="Information-Content">
        <div id ="Adventure-Bio"><h3>Content Description</h3><?php echo $info['bio'];?></div>
        </div>
        </div>
    </div>

            <br />
 <h1>Tweets(based on trip tag)</h1><h2></h2>
            <ul id ="twitter">
            </ul>
<!--Picture codes Goes here-->
<br/>
<h1>Trip Pictures</h1><h2></h2>



<?php
if (mysqli_num_rows($pictures) > 0)
{
    print "<table border='1' cellspacing='0'>";
     while($images = mysqli_fetch_array($pictures))
      {
        echo "<trstyle='background-color:#000000;' id='Personal-Highest'>";
        echo "<td>";
        echo "<img style='width:350px; height:350px;' src='".$images['filePath']."' /></br>";
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

<!--Comment codes Goes here!-->
<h1>Trip Comments</h1><h2></h2>
<br/>


<div id = "Comment-Section">
<div id = "Comment-Header">
<div id = "Username">User</div>
<div id = "Comment">Comment</div>





    </tr>

    <?php
    $query = "SELECT * FROM comments WHERE pageID = '$getid'";
    $result1 = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result1)){
    $username = $row['userID'];
    $query1 = "SELECT userName FROM users where userID = '$username'";
    $result2 = mysqli_query($db, $query1);
    $row1 = mysqli_fetch_assoc($result2);
    echo '<div id = "Comment-1">';
    echo '<div id = "User">'. strip_tags($row1['userName']) .'</div>';
    echo '<div id = "User-Comment">'. strip_tags($row['comment']) .'</div>';
     
       if($username == $current_user){
            echo '<a href="./?page=edit_comment&id='. $row['commentID'] .'">Edit</a>';
            
        }
    echo '</div>';
    }
    ?>
    <?php
    if(!empty($_SESSION['username'])){
        ?>
    <form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="post" style="text-align: center">
        <div id = "User-Comment"><textarea rows="4" cols="50" name = "commentText" id = "commentText">
        Add your Comment
        </textarea>
        <input type = "submit" name = "addCommentBtn" id = "addCommentBtn"/><br /></div>
        <?php
            }
            ?>
        
    </form>
    </div>
    </div>
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
