<?php
session_start();
require_once('assets/db.php');
require_once('assets/checklogin.php');
$userid = $_SESSION['userid'];
	 $postid = $_GET['postid'];

if(isset($_GET) & !empty($_GET)){

	 
     $res = $database->deletepost($postid);
	 if($res){
	 	header('Location: post.php');
	 }else{
	 	echo "delete failed";
	 }
}



?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Page</title>
<link rel="stylesheet" href="style.css">

</head>


<body>

</body>

</html>