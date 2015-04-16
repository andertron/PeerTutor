<?php
session_start();

include("../../DataUtil/common.inc.php");
include("../../DataUtil/DataAccess.inc.php");


$category = "";
$error = 0;
$errorMessage= "";
//include 'includes/_adminHeader.php';
if($_SESSION['screenName']){
    include '../../includes/_adminHeader.php';
    
    if(isset($_POST['btnSubmit'])){
      //Validation  
        $category = $_POST['category_name'];
        if (empty($category)){
            $error = 1;
        }
        
    if ($error <= 0){
    //Data Access
     $da = new DataAccess($link);
     $category_name = htmlentities($_POST['category_name']);
     $da->insert_category("$category_name");
     
     echo "<h1>Your category has been sucessfully added!</h1>";
    }else{
        $errorMessage = "<span style = 'color:red;'>Category field is empty!</span>";
    }
 }
?>
<form method="POST" >
<input type="text" name="category_name" style="width:750px" placeholder="Add Category" value="" required ><br>
<?php echo $errorMessage?><br>

<input type="submit" name="btnSubmit" value="Submit">

    
</form>
<?php		
}else{
    include '../../includes/_header.php';
    echo "you are not an admin";
}

include '../../includes/_footer.php';
?>
