<?php
/**
 * Created by PhpStorm.
 * User: RAD
 * Date: 15/12/2015
 * Time: 15:53
 */
//User scripts will go here!

$UserID1 = htmlentities($_GET['id']);

$profileQuery = mysqli_query($db, "SELECT * FROM users WHERE userID = '$UserID1'");

$pageDetails = mysqli_query($db, "SELECT * FROM pages WHERE userID = '$UserID1' ORDER BY PageID ASC" );

$getPics = mysqli_query($db, "SELECT * FROM picture_gallery_pages WHERE pageID = '$picsID'");

$userDetails = mysqli_fetch_array($profileQuery);



?>

<h1><?php echo $content_header ?></h1>
<h2> </h2>
    <div id ="Content-inner">

    <div id= "Profile-Content">
    	

    	<div id = "Profile-Horizontal-Split-Right">

    	<div id = "Profile-Horizontal-Split-Left">
    	<div id ="Profile-Picture"><img src="/Res/temp4.jpg"></div>
    	<div id ="Profile-bio"><h3>Bio</h3><?php echo $userDetails['bio']; ?></div>
    	</div>


    	<div id ="Information-Header"><h1><?php echo $userDetails['first_Name'] . " " . $userDetails['last_Name']; ?></h1></div>
    	<div id ="Information-Content">
    	<div id ="Adventure-Bio"><h3>My Trips</h3></div>
    	  <div id ="Personal-Columns">
    	    <?php
    	    while($pictures = mysqli_fetch_array($pageDetails)){
    	        $picsID = $pictures['PageID'];
    	        $getPics = mysqli_query($db, "SELECT * FROM picture_gallery_pages WHERE pageID = '$picsID' limit 3");
    	        while($images = mysqli_fetch_array($getPics)){
        		    echo '<a href="./?page=adventure&id=' . $pictures['PageID'] . '"><div id = "Personal-Highest" ><img src="'.$images['filePath'].'" tabindex ="0" alt = "' . $pictures['title'] . '"></div></a>';
    	        }
    	    }
    		?>
    	  </div>
    	</div>
    	</div>
    </div>




    <div id = "Adventure-Profile-Content-0">
    
    <div id = "Small-Img">
    <img id = "Big" src="./Res/temp2.jpg">
    </div>

    


    </div>
    



    </div>
    </div>


</div>
