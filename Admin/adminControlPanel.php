<?php 
session_start(); 
include( "../DataUtil/common.inc.php"); 
include( "../DataUtil/DataAccess.inc.php");

$roleID = $_SESSION['role'];

var_dump($roleID);

if($_SESSION[ 'screenName'] && $roleID == "Admin"){ 
include '../includes/_header.php';
$da=new DataAccess($link);

// Gets list of tutors
$getTutors=$da->get_tutors();

//Gets Tutor ID when edit is clicked!
if(isset($_GET['TutorID'])){

// Gets tutor ID 
$tutorID = $_GET['TutorID'];
//Grab tutor info by ID
$tutorByID=$da->get_tutor_by_id($tutorID);
//Grab tutor clock
$tutorClockByID= $da-> get_tutor_clock($tutorID);


var_dump($tutorByID);


}

//Validations for editing a tutor
if(isset($_POST['btnSubmitEdit'])){
    //Validations
    
    //
    $new_first_name = htmlentities($_POST['FirstName']);
    $new_last_name = htmlentities($_POST['LastName']);
    $new_email = htmlentities($_POST['Email']);
    $new_class_description = htmlentities($_POST['ClassTutored']);
    $new_availability = htmlentities($_POST['Availability']);
    $da ->update_tutor($tutorID, $new_first_name, $new_last_name, $new_email, $new_class_description, $new_availability);
    ?>
  
        <meta http-equiv="refresh" content="0">
      <?php
    
       
    
}

//VALIDATION FOR SEARCH CATEGORY
if(isset($_POST['btnSearch'])){
$searchCategory = htmlentities($_POST['search']);
$searchCategories=$da->get_categories_by_categoryName($searchCategory);

}
    ?>
    <div class="top-title-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="page-info">
                                    <h1 class="h1-page-title">Admin</h1>

                                    <h2 class="h2-page-desc">
                                       Control Panel
                                    </h2>

                                    <!-- BreadCrumb -->
                                    <div class="breadcrumb-container">
                                        <ol class="breadcrumb">
                                            <li>
                                                <a href="">Home</a>
                                            </li>
                                            <li class="active">Admin Control Panel</li>
                                        </ol>
                                    </div>
                                    <!-- BreadCrumb -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </tbody>
    </table>

    <div class="tab-container">
        <ul class="etabs">

            <li class="tab">
                <a href="#tab1"><i class=icon-list></i>View Tutors</a>
            </li>
            
            <li class="tab">
                <a href="#tab2"><i class=icon-file-add></i>Edit Tutor Info</a>
            </li>


            <li class="tab">
                <a href="#tab3"><i class=icon-file-add></i>View Hours Worked</a>
            </li>


            <li class="tab">
                <a href="#tab4"><i class=icon-arrow-up></i>View Tutees<?php echo $categoryName['category_name'] ?></a>
            </li>
            <li class="tab">
                <a href="#tab5"><i class=icon-search></i>Search for tutor</a>
            </li>

        </ul>

        <div class="tabs-content">
            <div id="tab1">
                <table class = "table">
                    <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Classes Tutored</th>
                        <th>Availability</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($getTutors as $getTutors){ 
                        echo("<tr>"); 
                        echo("<td>{$getTutors['TutorFirstName']}</td>");
                        echo("<td>{$getTutors['TutorLastName']}</td>");
                        echo("<td>{$getTutors['TutorEmail']}</td>");
                        echo("<td>{$getTutors['ClassDescription']}</td>");
                        echo("<td>{$getTutors['Availability']}</td>");
                        echo("<td><a href=\"adminControlPanel.php?TutorID={$getTutors['TutorID']}#tab2\">Select</a>"); 
                        echo( "</tr>"); 
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="tab2">
                <?php
                
                if(isset($_GET['TutorID'])){
                    
                    ?>
                <form method="POST">
                    First Name<br><input type="text" name="FirstName" style="width:750px" placeholder="First Name" value="<?php echo $tutorByID[0]['TutorFirstName'] ?>" required> <br>
                    Last Name<br><input type="text" name="LastName" style="width:750px" placeholder="Last Name" value="<?php echo $tutorByID[0]['TutorLastName'] ?>" required><br>
                    Email<br><input type="text" name="Email" style="width:750px" placeholder="Email" value="<?php echo $tutorByID[0]['TutorEmail'] ?>" required><br>
                    Class Tutored<br><textarea name="ClassTutored" cols = "50" rows = "4" style="width:750px" placeholder="Class Tutored" value="<?php echo $tutorByID[0]['ClassDescription'] ?>" required/><?php echo $tutorByID[0]['ClassDescription'] ?></textarea><br>
                    Availability<br><textarea name="Availability" cols = "50" rows = "4" style="width:750px" placeholder="Availability" value="<?php echo $tutorByID[0]['Availability'] ?>" required><?php echo $tutorByID[0]['Availability'] ?></textarea>
                    <br>
                
                    <br>

                    <input type="submit" name="btnSubmitEdit" value="Submit">


                </form>
                <?php
                }
                ?>
            </div>
            <div id="tab3">
        <?php
                if(isset($_GET['TutorID'])){
                    ?>
       <table class = "table">
                    <thead>
                        <th>Date</th>
                        <th>Tutor In</th>
                        <th>Tutor out</th>
                        <th>Time Worked</th>
                      
                        <th></th>
                    </thead>
                    <tbody>
                        <?php 
                        
                        foreach($tutorClockByID as $clockByID){ 
                            $date = strtotime($clockByID['tutorClockIn']);
                            $printDate = date("m/d/y", $date);
                            $intime = strtotime($clockByID['tutorClockIn']);
				            $printInTime = date("g:i:a", $intime);
				            $outTime = strtotime($clockByID['tutorClockOut']);
				            $printOutTime = date("g:i:a", $outTime);
				            
				            $hoursWorked = ((strtotime($printOutTime) - strtotime($printInTime)) /3600);
                        echo("<tr>"); 
                        echo("<td>$printDate</td>");
                        echo("<td>$printInTime</td>");
                        echo("<td>$printOutTime</td>");
                        echo("<td>$hoursWorked");
                   
                        echo("<td><a href=\"adminControlPanel.php?TutorID={$getTutors['TutorID']}#tab2\">Select</a>"); 
                        echo( "</tr>"); 
                        } 
                        ?>
                    </tbody>
                </table>
                
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
    }else{
    include '../includes/_header.php'; 
    echo "<center><h1>You are not an admin</h1></center>";
    echo "<center><a href=\"../index.php\">Return Home</a></center>";
    }
    
    include '../includes/_footer.php'; 
    ?>
