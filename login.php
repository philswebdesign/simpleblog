<?php
session_start();
require_once('assets/db.php');

 if(isset($_POST) & !empty($_POST)){
      $email = $database->sanitize($_POST['email']);
      $password = $database->sanitize($_POST['password']);

      $res = $database->login($email, $password);
	 $row = mysqli_fetch_assoc($res);

	 if(is_array($row) && !empty($row)) {
           
            $_SESSION['email'] = $row['email'];
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['name'] = $row['name'];
        }

 	}
   

 	 if(isset($_SESSION['userid'])) {
            header('Location: post.php');            
        }

?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="style.css">

</head>


<body>
<?php include('assets/heading.php'); ?>


<h1>Login Page</h1>



<form method="POST">

<input type="text" placeholder="EMAIL ADDRESS" name="email">
<div class="clr10"></div>
<input type="password" placeholder="PASSWORD" name="password">
<div class="clr10"></div>
<input type="submit" value="Login">

</form>

</body>

</html>