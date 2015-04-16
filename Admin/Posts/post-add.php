<?php
session_start();

include("../../DataUtil/common.inc.php");
include("../../DataUtil/DataAccess.inc.php");

$da = new DataAccess($link);
$post_id = $_GET['post_id'];
$post_name=$da->get_post_by_id("$post_id");
$categories =$da->get_categories();
//echo $post_name;

$postTitle = "";
//include 'includes/_adminHeader.php';
if($_SESSION['screenName']){
    include '../../includes/_adminHeader.php';

if(isset($_POST['btnSubmit'])){
    //Validations
    
    //Validate post title
    $postTitle = $_POST['post_title'];
    
    //check to see if updating an exsiting category
    //or inserting a new one
    // $new_category_name = "";
    $new_post_title = htmlentities($_POST['post_title']);
    $new_post_date = htmlentities($_POST['post_date']);
    $new_user_id = htmlentities($_POST['user_id']);
    $new_category_id = htmlentities($_POST['category_id']);
    $new_post_active = htmlentities($_POST['post_active']);
    $new_post_content = $_POST['post_content'];
    $new_post_raw_content = htmlentities($_POST['post_raw_content']);
    $new_post_description = htmlentities($_POST['post_description']);
   
    $da->insert_post( $new_post_title, $new_post_date, $new_user_id,$new_category_id, $new_post_active, $new_post_content, $new_post_raw_content, $new_post_description);
    echo 'It submitted.';
    
    
    //
    
}
       ?>
<form method= "POST" action="">
Post Title:<br><input type="text" style="width:750px" name="post_title" placeholder ="Post title" maxlength ="100" value="" required><br>
User_Id<br><input type="text" name="user_id" style="width:750px" placeholder ="user_id" maxlength ="100" value="" required><br>
Category:<br>
    <select name="category_id" required>
     <?php
				foreach($categories as $cat){
					echo("<option value = '{$cat['category_id']}'>{$cat['category_name']}</option>");
				}
				?>
    </select><br>
Post Date:<br><input type="Date" name="post_date"  value="" required><br>
Post Description:<br> <input type="text" name="post_description" style="width:750px" placeholder ="Post Desctiption" maxlength = "160" value=""required><br>
Post Active:
<select name = "post_active">
  <option value="yes">Yes</option>
  <option value="no">No</option>
</select>
<br>
Post Content:<br> <textarea name="post_content" style="width:750px" rows="4" cols="50"placeholder ="Post Content" value="" required></textarea><br>
Post raw content:<br> <textarea style="width:750px" name="post_raw_content" rows="4" cols="50" placeholder ="Post Raw Content" value="" required></textarea><br>


<input type="submit" name="btnSubmit" value="Submit">
</form>


<?php		
}else{
    include '../../includes/_header.php';
    echo "you are not an admin";
}

include '../../includes/_footer.php';
?>

