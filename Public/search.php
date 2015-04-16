<?php
include( "../DataUtil/common.inc.php"); 
include( "../DataUtil/DataAccess.inc.php");
include ('../includes/_header.php');


$da = new DataAccess($link);
$searchBy = 0;
if(isset($_POST['btnSearch'])){
    
$searchBy = $_POST['searchBy'];

if($searchBy == 1){
    //Search by Tutor
$searchName = $_POST['search'];
$tutor=$da->search_by_tutor($searchName);

}elseif($searchBy == 2){
    //Search by classes
    
$searchName = $_POST['search'];
$tutor=$da->search_by_class($searchName);
}

}


?>
<div class="top-title-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="page-info">
                                    <h1 class="h1-page-title">Search</h1>

                                    <h2 class="h2-page-desc">
                                       Search by tutor or class
                                    </h2>

                                    <!-- BreadCrumb -->
                                    <div class="breadcrumb-container">
                                        <ol class="breadcrumb">
                                            <li>
                                                <a href="">Home</a>
                                            </li>
                                            <li class="active">Search</li>
                                        </ol>
                                    </div>
                                    <!-- BreadCrumb -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div id="tab4">
                <form method="POST" action="">
                    <br>
                    <select name="searchBy">
                          <option value="1">Tutors</option>
                          <option value="2">Classes</option>
                    </select>
                <input type="text" style="width:300px" name="search" placeholder="Search..."value="" required>
                <input type="submit" name="btnSearch" value="Search">
             
                </form>
                
                
                <table class ="table">
                    <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Classes Tutored</th>
                        <th>Availability</th>
                    </thead>
                    <tbody>
                        <?php 
                        
                        foreach($tutor as $tutors){ 
                            
                        echo("<tr>"); 
                        echo("<td>{$tutors['TutorFirstName']}</td>");
                        echo("<td>{$tutors['TutorLastName']}</td>");
                        echo("<td>{$tutors['TutorEmail']}</td>");
                        echo("<td>{$tutors['ClassDescription']}</td>");
                        echo("<td>{$tutors['Availability']}</td>");
                        echo( "</tr>"); 
                        } 
                      
                        
                        ?>
                    </tbody>
                </table>
                
                
                
                
            </div>
<?php
include ('../includes/_footer.php');

?>