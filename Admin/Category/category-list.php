<?php session_start(); include( "../../DataUtil/common.inc.php"); 
include( "../../DataUtil/DataAccess.inc.php"); //
include 'includes/_adminHeader.php'; 

if($_SESSION[ 'screenName']){ 
include '../../includes/_adminHeader.php'; 
$da=new DataAccess($link);


$categories=$da->get_categories($startNum);

//Gets category ID when edit is clicked!
if(isset($_GET['category_id'])){
$category_id = $_GET['category_id'];
$categoryName=$da->get_categories_by_id($category_id);


}

//Variables for search category
$searchCategory = "";
$searchCategories = "";


//Validations for addming a new category
if(isset($_POST['btnSubmit'])){
    //Validation 
    $category = $_POST['category_name']; 
    if (empty($category)){ 
    $error = 1; 
        
    } 
    if ($error<=0 ){ 
        //Data Access 
    //$da=new DataAccess($link); 
    $category_name=htmlentities($_POST[ 'category_name']);
    $da->insert_category("$category_name"); 
    echo "<h1>Your category has been sucessfully added!</h1>"; 
    ?>
    <meta http-equiv="refresh" content="0">
    <?php
    }
    else{ $errorMessage = "<span style='color:red;'>Category field is empty!</span>"; 
    }
    } 

//Validations for editing a category
if(isset($_POST['btnSubmitEdit'])){
    //Validations
    $new_category_name = "";
    $category = $_POST['category_name'];
    
        if (empty($category)){
            $error = 1;
        }
        if($error <=0){

    $new_category_name = htmlentities($_POST['category_name']);
   
    $da->update_category($new_category_name, $category_id);
    ?>
    <meta http-equiv="refresh" content="0">
    <?php
    
    echo '<h1>Your category has been updated!</h1>';
    
        }else{
            $errorMessage = "<span style = 'color:red;'>Category field is empty!</span>";
        }
    //
    
}

//VALIDATION FOR SEARCH CATEGORY
if(isset($_POST['btnSearch'])){
$searchCategory = htmlentities($_POST['search']);
$searchCategories=$da->get_categories_by_categoryName($searchCategory);

}
    ?>
    </tbody>
    </table>

    <div class="tab-container">
        <ul class="etabs">

            <li class="tab">
                <a href="#tab1"><i class=icon-list></i>Category List</a>
            </li>


            <li class="tab">
                <a href="#tab2"><i class=icon-file-add></i>Add Category</a>
            </li>


            <li class="tab">
                <a href="#tab3"><i class=icon-arrow-up></i>Update category: <?php echo $categoryName['category_name'] ?></a>
            </li>
            <li class="tab">
                <a href="#tab4"><i class=icon-search></i>Search Category</a>
            </li>

        </ul>

        <div class="tabs-content">
            <div id="tab1">
                <table class = "table">
                    <thead>
                        <th>Category name</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($categories as $cat){ 
                        echo("<tr>"); 
                        echo("<td>{$cat['category_name']}</td>");
                        echo("<td><a href=\"category-list.php?category_id={$cat['category_id']}\">EDIT</a></td>"); 
                        echo( "</tr>"); 
                        } 
                        
                       
             
                        
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="tab2">
                <form method="POST">
                    <input type="text" name="category_name" style="width:750px" placeholder="Add Category" value="" required>
                    <br>
                    <?php echo $errorMessage?>
                    <br>

                    <input type="submit" name="btnSubmit" value="Submit">


                </form>
            </div>
            <div id="tab3">
        <?php
                if(isset($_GET['category_id'])){
                    
        ?>
        Category Name: 
                <form method= "POST" action="">
                <input type="text" style="width:750px" name="category_name" value="<?php echo $categoryName['category_name'] ?>" required><br>
                <?php 
                echo $errorMessage?>
                <br>

                <input type="submit" name="btnSubmitEdit" value="Submit">
                </form>
        <?php
      echo $_GET['category_id'];

    }
    ?>
            </div>
            
            <div id="tab4">
                <form method="POST" action="">
                <input type="text" style="width:300px" name="search" placeholder="Search..."value="" required>
                <input type="submit" name="btnSearch" value="Search">
             
                </form>
                
                
                <table class ="table">
                    <thead>
                        <th>Category name</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php 
                        
                        foreach($searchCategories as $catName){ 
                            
                        echo("<tr>"); 
                        echo("<td>{$catName['category_name']}</td>");
                        echo("<td><a href=\"category-list.php?category_id={$catName['category_id']}\">EDIT</a></td>"); 
                        echo( "</tr>"); 
                        } 
                      
                        
                        ?>
                    </tbody>
                </table>
                
                
                
                
            </div>
        </div>

    </div>

    <?php 
    }else
    { 
    include '../../includes/_header.php'; 
    echo "you are not an admin"; } 
    include '../../includes/_footer.php'; 
    ?>
