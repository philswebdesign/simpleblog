<?php
session_start();
require_once('assets/db.php');
$res = $database->showposthome();
?>
<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="style.css">

</head>


<body>

<?php include('assets/heading.php'); ?>



<h1>Blog</h1>
<div class="clr20"></div>
<div id="wrap1000">
<?php while($rpost = mysqli_fetch_assoc($res)){ ?>
<div class="colblog">
<img src="images/<?php echo $rpost['image']; ?>" class="fimage">
<h2><?php echo $rpost['title']; ?></h2>
<div class="blogcont"><?php echo $rpost['description']; ?></div>

</div>
<div class="clr10"></div>
<?php } ?>

<div class="pagination"><?php $res = $database->page(); ?></div>

</div>


</body>

</html>