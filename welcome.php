<?php
/**
 * Created by PhpStorm.
 * User: RAD
 * Date: 08/12/2015
 * Time: 11:53
 * Welcome Page for top rated pages
 */

$queryPages = "SELECT * FROM pages";
$resultPages = mysqli_query($db, $queryPages);
$queryPages  = "SELECT * FROM votes GROUP BY ";

$vote = mysqli_query($db,"SELECT SUM(vote_Count) as count, pageID FROM `votes` group by pageID order by count desc limit 1");




?>

<head>

<title>
	Home 
</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id = "Welcome_Inner_Wrap">
<h1><?php echo $content_header ?></h1>
<h2> </h2>

<div id ="Content-inner">

	<div id = "Welcome-Content-blob">
		<div id = "Banner_Container">
			<div class = "Scroll_Banner">
				<?php
				while($pictures = mysqli_fetch_array($vote)){
					$picsID = $pictures['pageID'];
					$getPics = mysqli_query($db, "SELECT * FROM picture_gallery_pages WHERE pageID = '$picsID'");
					while($images = mysqli_fetch_array($getPics)){
						echo '<img src="'.$images['filePath'].'" alt = "' . $pictures['title'] . '">';
					}
				}
				?>
			</div>
		</div>
	</div>


</div>









</div>


</div>



<br />

</body>



</html>