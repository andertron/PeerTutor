<?php
session_start();

include("../../DataUtil/common.inc.php");
include("../../DataUtil/DataAccess.inc.php");

$da = new DataAccess($link);
$post_id = $_GET['post_id'];
$post_name=$da->get_post_by_id("$post_id");
//echo $post_name;
var_dump($post_name[0]['post_content']);
//include 'includes/_adminHeader.php';
if($_SESSION['screenName']){
    include '../../includes/_adminHeader.php';

if(isset($_POST['btnSubmit'])){
    //Validations
    echo 'It submitted.';
    //check to see if updating an exsiting category
    //or inserting a new one
    // $new_category_name = "";
    $new_post_title = htmlentities($_POST['post_title']);
    $new_post_active = htmlentities($_POST['post_active']);
    $new_post_content = $_POST['post_content'];
    $new_post_raw_content = htmlentities($_POST['post_raw_content']);
    $new_post_description = htmlentities($_POST['post_description']);
   
    $da->update_posts($post_id, $new_post_title, $new_post_active, $new_post_content, $new_post_raw_content, $new_post_description);
    
    
    //
    
}else{
    //retrieve category by id
    if(isset($_GET['post_id'])){
        ?>
       
<form method= "POST" action="">
Post Title:<br><input type="text" name="post_title" placeholder ="Post title" maxlength ="100" style="width:750px" value="<?php echo $post_name[0]['post_title'] ?>" required><br>
Post Description:<br> <input type="text" name="post_description" placeholder ="Post Desctiption" style="width:750px" maxlength = "160" value="<?php echo $post_name[0]['post_description'] ?>"required><br>
Post Active:
<select name = "post_active">
  <option value="yes">Yes</option>
  <option value="no">No</option>
</select>
<br>
Post Content:<br> <textarea cols = "50" rows = "4" style="width:750px" name="post_content" placeholder ="Post Content" value="<?php echo $post_name[0]['post_content'] ?>" required><?php echo $post_name[0]['post_content'] ?></textarea><br>
Post raw content:<br> <textarea  name="post_raw_content"  placeholder ="Post Raw Content" rows="4" cols="50" style = "width:750px" value="<?php echo $post_name[0]['post_raw_content'] ?>" required><?php echo $post_name[0]['post_raw_content'] ?></textarea><br>


<input type="submit" name="btnSubmit" value="Submit">
</form>
        <?php
      echo $_GET['post_id'];

    }
    
    if($category_id > 0){
        
    }
    
}



     ?>

<?php		
}else{
    include '../../includes/_header.php';
    echo "you are not an admin";
}

include '../../includes/_footer.php';
?>

