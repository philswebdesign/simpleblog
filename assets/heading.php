<div id="wrapfull" class="heading">
<a href="index.php">Home</a> 
<?php if(!isset($_SESSION['userid'])) { ?> <a href="login.php">Login</a> <a href="register.php">Register</a> <?php } ?> <?php if(isset($_SESSION['userid'])) { ?><a href="post.php">Blog</a> <a href="logout.php">Logout</a> <?php } ?>
</div>