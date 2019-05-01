<?php
session_start();
require_once('assets/db.php');
require_once('assets/checklogin.php');
if(isset($_POST) & !empty($_POST)){

	 $userid = $_SESSION['userid'];
	
	 $title = $database->sanitize($_POST['title']);
	 $description = $database->sanitize($_POST['description']);
	 $image = $database->sanitize($_FILES['image']['name']);

     if (move_uploaded_file($_FILES['image']['tmp_name'], getcwd() . "/images/" . $_FILES['image']['name'])) {
        //echo "uploaded";
    } else {
        //echo  "Upload failed!";
    }

     $res = $database->addpost($userid, $title, $description, $image);
	 if($res){
	 	//echo "post added";
	 }else{
	 	//echo "post failed";
	 }
}


 $res = $database->showpost();




?>
<!DOCTYPE html>
<html>
<head>
<title>Add Post Page</title>
<link rel="stylesheet" href="style.css">

</head>


<body>
<?php include('assets/heading.php'); ?>
<h1>Welcome <?php echo $_SESSION['name']; ?></h1>







<h2>Add Post</h2>
<form enctype="multipart/form-data" method="POST">
<input type="text" name="title" placeholder="POST TITLE" >
<div class="clr10"></div>
<textarea name="description" placeholder="POST DESCRIPTION"></textarea>
<div class="clr10"></div>
<input type="file" name="image">
<div class="clr10"></div>
<input type="submit" value="Add Post">
</form>



<h2>Blog Post</h2>
<div id="wrap1000">
<?php while($rpost = mysqli_fetch_assoc($res)){ ?>
<div class="col1"><?php echo $rpost['title']; ?></div>
<div class="col2"><a href="edit.php?postid=<?php echo $rpost['postid']; ?>">edit</a></div>
<div class="col3"><a href="delete.php?postid=<?php echo $rpost['postid']; ?>">delete</a></div>
<?php } ?>
</div>
</body>

</html>