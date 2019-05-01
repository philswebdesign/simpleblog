<?php
session_start();
require_once('assets/db.php');
require_once('assets/checklogin.php');
$postid = $_GET['postid'];
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

     $res = $database->updatepost($title, $description, $image, $postid);
	 if($res){
	 	//echo "post updated";
	 }else{
	 	//echo "update failed";
	 }
}
 $res = $database->showpost($_GET['postid']);
 $rpost = mysqli_fetch_assoc($res);




?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Page</title>
<link rel="stylesheet" href="style.css">

</head>


<body>
<?php include('assets/heading.php'); ?>

<h1>Welcome <?php echo $_SESSION['name']; ?></h1>






<h2>Edit Post</h2>
<form enctype="multipart/form-data" method="POST">
<input type="text" name="title" placeholder="POST TITLE" value="<?php echo $rpost['title']; ?>">
<div class="clr10"></div>
<textarea name="description" placeholder="POST DESCRIPTION"><?php echo $rpost['description']; ?></textarea>
<div class="clr10"></div>
<input type="file" name="image">
<div class="clr10"></div>
<input type="submit" value="Update Post">
</form>



</body>

</html>