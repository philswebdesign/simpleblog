<?php
require_once('assets/db.php');
 if(isset($_POST) & !empty($_POST)){

	 $email = $database->sanitize($_POST['email']);
	  $name = $database->sanitize($_POST['name']);
	   $password = $database->sanitize($_POST['password']);
	

	 $res = $database->create('User',$email, $name, $password);
	 if($res){
	 	//echo "registration successfull";
	 }else{
	 	//echo "failed to register";
	 }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<link rel="stylesheet" href="style.css">
<script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script src="validate.js"></script>


</head>


<body>
<?php include('assets/heading.php'); ?>
<h1>Registration Page</h1>

<form method="POST" id="form1" name="registration">

<input type="text" placeholder="EMAIL ADDRESS" name="email">
<div class="clr10"></div>
<input type="text" placeholder="NAME" name="name">
<div class="clr10"></div>
<input type="password" placeholder="PASSWORD" name="password">
<div class="clr10"></div>
<input type="password" placeholder="CONFIRM PASSWORD" name="password2">
<div class="clr10"></div>
<input type="submit" value="Register">

</form>

</body>

</html>