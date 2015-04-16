<?php
/**
* Handles all calls to the database for the entire application
*/
class DataAccess{
	
	/**
	* @var resource $link 	The connection to the database
	*/
	private $link;
	
	/**
	* Constructor method
	* 
	* @param resource $link 	Sets the $link property
	*/
	function __construct($link){
		$this->link = $link;
	}

	/**
	* Authenticates a user for accessing the control panel
	* 
	* @param string email
	* @param string password
	* 
	* @return assoc array if login is authenticated, returns false if authentication fails
	*/
	function login($email, $password){
	
		$email = mysqli_real_escape_string($this->link, $email);
		$password = mysqli_real_escape_string($this->link, $password);

		$qStr = "SELECT user_display_name FROM users WHERE user_email = '$email' AND user_password = '$password' AND user_active = 'yes'";
		//die($qStr);

		$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
		$num_rows = $result->num_rows;
		
		if($num_rows == 1){
			// NOTE: not the diff between msqli_fetch_array() and mysqli_fetch_assoc()
			// return mysqli_fetch_array($result);
			return mysqli_fetch_assoc($result);
		}elseif($num_rows > 1){
			$this->handle_error("Duplicate email and passwords in DB!");
			return false;
		}else{
			return false;
		}
	}

	function handle_error($err_msg){
		if(DEBUG_MODE){
			die($err_msg);
		}else{
			//TODO: handle errors in production
		}
	}
	
	function get_categories(){
		$qStr ="SELECT category_id, category_name FROM categories ORDER BY category_name";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$categories = array();
		while($row = mysqli_fetch_assoc($result)){
			$categories[] =$row;
		}
		
		return $categories;
	}
	
		
	function get_images(){
		$qStr ="SELECT image_id, image_filename, image_active FROM images ORDER BY image_filename";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$image = array();
		while($row = mysqli_fetch_assoc($result)){
			$image[] =$row;
		}
		
		return $image;
	}
	
	
	function get_post(){
		$qStr ="SELECT post_id, post_title, post_date, post_content FROM posts ORDER BY post_title";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$post = array();
		while($row = mysqli_fetch_assoc($result)){
			$post[] =$row;
		}
		
		return $post;
	}
	
	
	function insert_category($categories){
		$qStr = "INSERT INTO categories(category_id, category_name) VALUES (NULL, '$categories')";
		$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
		

	
		}
		
	function insert_image($image){
		$qStr = "INSERT INTO images(image_id, image_filename, image_active) VALUES (NULL, '$image', 'yes')";
		$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	}
	
	function insert_post($title, $date, $user_id, $category_id, $active, $content, $raw_content, $description){
		$qStr = "INSERT INTO posts(post_id, post_date, post_title, user_id, post_active, category_id, post_content,post_raw_content, post_description) VALUES (NULL, '$date', '$title', '$user_id', '$active', '$category_id', '$content', '$raw_content', '$description')";
		$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	}

	function get_categories_by_id($category_id){
		$qStr = "SELECT category_name FROM categories WHERE category_id= '$category_id'";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$row = mysqli_fetch_assoc($result);
		
	
		return $row;
}
	function get_post_by_id($post_id){
		$qStr = "SELECT post_title, post_active, post_content, post_raw_content, post_description FROM posts WHERE post_id= '$post_id'";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
	

		$row= mysqli_fetch_assoc($result);
		
		$name[] = $row;
		return $name;
}
	function update_category($category, $category_id){
		$qStr = "UPDATE categories SET category_id = category_id, category_name = '$category' WHERE category_id = '$category_id'";
		$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	}
	
	function update_posts(  $post_id, $title, $post_active, $post_content, $post_raw_content, $post_description){
			$qStr = "UPDATE `posts` SET `post_id`=post_id,`post_date`=post_date,`post_title`='$title',`user_id`=user_id,`post_active`='$post_active',`category_id`=category_id,`post_content`='$post_content',`post_raw_content`='$post_raw_content',`post_description`='$post_description' WHERE post_id = '$post_id'";
			$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
			$posts = array();
			while($row = mysqli_fetch_assoc($result)){
			$posts[] =$row;
			}
			return $posts;
	}
	
	
	function get_categories_by_categoryName($category){
		$qStr ="SELECT category_id, category_name FROM categories WHERE `category_name` LIKE '%$category%' ORDER BY category_name";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$categories = array();
		while($row = mysqli_fetch_assoc($result)){
			$categories[] =$row;
		}
		
		return $categories;
		
		
	
	}
	//search by tutor
	function search_by_tutor($tutor){
		
		
		$qStr ="SELECT TutorFirstName, TutorLastName, TutorEmail, ClassDescription, Availability FROM tblTutors WHERE (TutorFirstName LIKE '%$tutor%') OR (TutorLastName LIKE '%$tutor%') OR ((concat(TutorFirstName, ' ', TutorLastName) LIKE '%$tutor%'))";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$tutor = array();
		while($row = mysqli_fetch_assoc($result)){
			$tutor[] =$row;
		}
		
		return $tutor;
	}
	//search by class
	function search_by_class($class){
		$qStr ="SELECT TutorFirstName, TutorLastName, TutorEmail, ClassDescription, Availability FROM tblTutors WHERE (ClassDescription LIKE '%$class%')";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$classes = array();
		while($row = mysqli_fetch_assoc($result)){
			$classes[] =$row;
		}
		
		return $classes;
		
	}
	//Get All tutors
	function get_tutors(){
		$qStr ="SELECT TutorID, TutorFirstName, TutorLastName, TutorEmail, ClassDescription, Availability FROM tblTutors";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$tutors = array();
		while($row = mysqli_fetch_assoc($result)){
			$tutors[] =$row;
		}
		
		return $tutors;
	}
	//Get tutor by ID
	function get_tutor_by_id($tutorID){
		$qStr ="SELECT TutorID, TutorFirstName, TutorLastName, TutorEmail, ClassDescription, Availability FROM tblTutors WHERE TutorID = '$tutorID'";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$tutors = array();
		while($row = mysqli_fetch_assoc($result)){
			$tutors[] =$row;
		}
		
		return $tutors;
	}
	
	function update_tutor(  $TutorID, $TutorFirstName, $TutorLastName, $TutorEmail, $ClassDescription, $Availability){
			$qStr = "UPDATE `tblTutors` SET `TutorID`=TutorID,`TutorLastName`='$TutorFirstName',`TutorLastName`='$TutorFirstName',`TutorLastName`='$TutorLastName',`TutorEmail`='$TutorEmail',`ClassDescription`='$ClassDescription',`Availability`='$Availability' WHERE TutorID = '$TutorID'";
			$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
			$posts = array();
			while($row = mysqli_fetch_assoc($result)){
			$posts[] =$row;
			}
			return $posts;
	}
	
	//get punch-in table array from database
	function get_punch_table(){
		$qStr ="SELECT * FROM tblStudentClock";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$punchTable = array();
		while($row = mysqli_fetch_assoc($result)){
			$punchTable[] =$row;
		}
		
		return $punchTable;
	}
	//insert for student punch-in table
	function insert_punch_table_data($studID, $studFirstName, $studLastName, $studClockIn){
	$qStr = "INSERT INTO tblStudentClock(studClockID, studFirstName, studLastName, studClockIn, studClockOut, TutorID) VALUES('$studID', '$studFirstName', '$studLastName', STR_TO_DATE( '$studClockIn', '%Y-%m-%d %H:%i:%s' ), '', 1)";
	$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	return $result;
	}
	
	//update for student punch table
	function update_punch_table_data($studClockOut, $studID){
		$qStr = "UPDATE tblStudentClock SET studClockOut=STR_TO_DATE( '$studClockOut', '%m-%d-%Y %H:%i:%s' ) WHERE studClockID = $studID";
		$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	if(!$result){
      	return false;
      }
      $row = mysqli_fetch_assoc($result);
      return $result;
	}
}
// notice there is no closing php delimiter for files that are meant to be embedded STR_TO_DATE('12-01-2014 00:00:00','%m-%d-%Y %H:%i:%s')