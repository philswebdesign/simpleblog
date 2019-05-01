<?php

class Database{

  private $connection;

	function __construct()
	{
		$this->connect_db();
	}

   ///////connect ///////
	public function connect_db(){
		$this->connection = mysqli_connect('localhost', 'root', '', 'simpleblog');
		if(mysqli_connect_error()){
			die("Database Connection Failed");
		}
	}
	///////connect ///////

	///////register////////
    	public function create($role, $email,$name,$password){
		$sql = "INSERT INTO `users` (role, email, name, password) VALUES ('$role', '$email', '$name', '$password')";
		$res = mysqli_query($this->connection, $sql);
		if($res){
	 		return true;
		}else{
			return false;
		}
	}
	///////register///////


	//////////login/////////

    	public function login($email, $password){
		$sql = "SELECT * FROM `users` WHERE email='$email' and password='$password'";
 		$res = mysqli_query($this->connection, $sql);
 		return $res;
	}

	//////////login////////



	//////////show post h /////////

    	public function showposthome(){
    	$limit = 10;
    	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; $start_from = ($page-1) * $limit;	
		$sql = "SELECT * FROM `post`";
        $sql .= " ORDER BY postid DESC";
        $sql .= " LIMIT $start_from, $limit";
        $res = mysqli_query($this->connection, $sql);
 		return $res;
	}

	//////////show post h////////

	////////////page///////////
  public function page() {
  	$limit = 10;
	$sql = "SELECT COUNT(postid) FROM post";  
    $res = mysqli_query($this->connection, $sql); 
    $row = mysqli_fetch_row($res);  
    $total_records = $row[0];  
    $total_pages = ceil($total_records / $limit);  
    $pagLink = "<div class='pagination'>";  
    for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<a href='index.php?page=".$i."'>".$i."</a>";  
                 } 
     echo $pagLink . "</div>";



   }

	////////////page///////////


	//////////show post/////////

    	public function showpost($postid=null){
		$sql = "SELECT * FROM `post` p INNER JOIN `users` u on p.userid = u.userid";
		if($postid){ $sql .= " WHERE postid=$postid";}
		if($_SESSION['role'] == 'User') {$sql .= " AND u.userid=" . $_SESSION['userid']; }
        $sql .= " ORDER BY p.postid DESC";
        $res = mysqli_query($this->connection, $sql);
 		return $res;
	}

	//////////show post////////


	///////add post////////
   	public function addpost($userid, $title, $description, $image){
		$sql = "INSERT INTO `post` (userid, title, description, image) VALUES ('$userid','$title', '$description', '$image')";
		$res = mysqli_query($this->connection, $sql);
		if($res){
	 		return true;
		}else{
			return false;
		}
	}
	///////add post///////


    ///////edit post////////
  	public function updatepost($title,$description,$image, $postid){
		$sql = "UPDATE `post` SET title='$title', description='$description', image='$image' WHERE postid=$postid";
		$res = mysqli_query($this->connection, $sql);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	///////edit post///////



	///////delete post //////
    
     	public function deletepost($postid){
		$sql = "DELETE FROM `post` WHERE postid=$postid";
 		$res = mysqli_query($this->connection, $sql);
 		if($res){
 			return true;
 		}else{
 			return false;
 		}
	}

	//////delete post///////



	////////sanitize//////

   	public function sanitize($var){
		$return = mysqli_real_escape_string($this->connection, $var);
		return $return;
	}

	////////sanitize//////

}

$database = new Database();



?>