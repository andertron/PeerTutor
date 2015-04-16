<?php
session_start();

include("../../DataUtil/common.inc.php");
include("../../DataUtil/DataAccess.inc.php");
$category = "";
$error = 0;
$errorMessage= "";

$da = new DataAccess($link);
$category_id = $_GET['category_id'];
$categoryName=$da->get_categories_by_id($category_id);

var_dump($categoryName[0]['category_name']);

//include 'includes/_adminHeader.php';
if($_SESSION['screenName']){
    include '../../includes/_adminHeader.php';

if(isset($_POST['btnSubmit'])){
    //Validations
    $new_category_name = "";
    $category = $_POST['category_name'];
    
        if (empty($category)){
            $error = 1;
        }
        if($error <=0){

    $new_category_name = htmlentities($_POST['category_name']);
   
    $da->update_category($new_category_name, $category_id);
    
    echo '<h1>Your category has been updated!</h1>';
    
        }else{
            $errorMessage = "<span style = 'color:red;'>Category field is empty!</span>";
        }
    //
    
}
    //retrieve category by id
    if(isset($_GET['category_id'])){
        ?>
        Category Name: 
<form method= "POST" action="">
<input type="text" style="width:750px" name="category_name" value="<?php echo $categoryName['category_name'] ?>" required><br>
<?php echo $errorMessage?><br>

<input type="submit" name="btnSubmit" value="Submit">
</form>
        <?php
      echo $_GET['category_id'];

    }
    
    if($category_id > 0){
        
    }
    




     ?>

<?php		
}else{
    include '../../includes/_header.php';
    echo "you are not an admin";
}

include '../../includes/_footer.php';
?>

