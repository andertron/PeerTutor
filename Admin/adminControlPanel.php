<?php 
session_start(); 
include( "../DataUtil/common.inc.php"); 
include( "../DataUtil/DataAccess.inc.php");

$roleID = $_SESSION['role'];


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
//Grab tutees 
$getTutees = $da->get_tutee($tutorID);

}

if(isset($_POST['btnSubmitAddClock'])){
    $newTutorClockIn = htmlentities($_POST['addClockIn']);
    $newTutorClockOut = htmlentities($_POST['addClockOut']);
    
    $da->insert_new_tutor_clock($tutorID,$newTutorClockIn,$newTutorClockOut);
     ?>
  
        <meta http-equiv="refresh" content="0">
      <?php
}

if(isset($_GET['tutorClockID'])){

// Gets tutor clock ID
$tutorClockID = $_GET['tutorClockID'];



}
if(isset($_POST['btnSubmitAdd'])){
    $str = htmlentities($_POST['addTutorID']);
    $add_tutor_id = (int)$str;
    $add_first_name = htmlentities($_POST['addFirstName']);
    $add_last_name = htmlentities($_POST['addLastName']);
    $add_email = htmlentities($_POST['addEmail']);
    $add_description = htmlentities($_POST['addClassTutored']);
    $add_Availability = htmlentities($_POST['addAvailability']);
    $add_password = htmlentities($_POST['addPassword']);
    
    $da->insert_tutor($add_tutor_id, $add_first_name, $add_last_name, $add_email, $add_description, $add_Availability, $add_password);
    
    ?>
  
        <meta http-equiv="refresh" content="0">
      <?php
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

if(isset($_POST['btnSubmitEditClock'])){
    $new_Clock_In = htmlentities($_POST['clockIn']);
    $new_Clock_Out = htmlentities($_POST['clockOut']);
    
    $da->update_tutor_clock($new_Clock_In,$new_Clock_Out, $tutorClockID);
    ?>
    
    <meta http-equiv="refresh" content="0">
    <?php
}
    ?>
    
     
<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css"/ >
<script type="text/javascript" scr="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.datetimepicker.js"></script>
<script>
jQuery('#datetimepicker').datetimepicker();
</script>

    
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
                <a href="#tab4"><i class=icon-arrow-up></i>Edit Hours Worked</a>
            </li>
            <li class="tab">
                <a href="#tab5"><i class=icon-arrow-up></i>View Tutees</a>
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
                <form method="POST">
                    Tutor ID<br><input type="text" name="addTutorID" style="width:750px" placeholder="Tutor ID" value="" required> <br>
                    First Name<br><input type="text" name="addFirstName" style="width:750px" placeholder="First Name" value="" required> <br>
                    Last Name<br><input type="text" name="addLastName" style="width:750px" placeholder="Last Name" value="" required><br>
                    Email<br><input type="email" name="addEmail" style="width:750px" placeholder="Email" value="" required><br>
                    Class Tutored<br><textarea name="addClassTutored" cols = "50" rows = "4" style="width:750px" placeholder="Class Tutored" value="" ></textarea><br>
                    Availability<br><textarea name="addAvailability" cols = "50" rows = "4" style="width:750px" placeholder="Availability" value=""></textarea><br>
                    Password<br><input type="password" name="addPassword" style="width:750px" placeholder="password" value="" required><br>
                    <br>
                
                    <br>

                    <input type="submit" name="btnSubmitAdd" value="Submit">


                </form>
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
                }else{
                    echo "Please select a tutor.";
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
                        echo("<tr>"); 
                        echo("<td>$printDate</td>");
                        echo("<td>$printInTime</td>");
                        echo("<td>$printOutTime</td>");
                     
                   
                        echo("<td><a href=\"adminControlPanel.php?TutorID={$clockByID['TutorID']}&tutorClockID={$clockByID['tutorClockID']}#tab4\">Edit</a>"); 
                        echo( "</tr>"); 
                        } 
                        ?>
                    </tbody>
                </table>
                <h1>Add New Clock In/Out Time:</h1>
                 <?php
               if(isset($_GET['TutorID'])){
                   ?>
                    Format: yyyy-mm-dd hh:mm:ss:
                    
                    <form method="POST">
                    Clock In<br><input type="text" name="addClockIn" style="width:750px" placeholder="Click In" value="" required> <br>
                    Clock Out<br><input type="datetime" name="addClockOut" style="width:750px" placeholder="Clock Out" value="" required><br>
                    
                    <br>
                
                    <br>

                    <input type="submit" name="btnSubmitAddClock" value="Submit">
                    
                </form>
                  <?php
               }
               ?>
                
        <?php
     

    }else{
        echo "Please select a tutor.";
    }
    ?>
            </div>
             <div id="tab4">
        <?php
               if(isset($_GET['tutorClockID'])){
                   ?>
                    Format yyyy/mm/dd hh:mm:ss:
                    <form method="POST">
                    Clock In<br><input type="text" name="clockIn" style="width:750px" placeholder="First Name" value="<?php echo $tutorClockByID[0]['tutorClockIn'] ?>" required> <br>
                    Clock Out<br><input type="text" name="clockOut" style="width:750px" placeholder="Last Name" value="<?php echo $tutorClockByID[0]['tutorClockOut'] ?>" required><br>
                    
                    <br>
                
                    <br>

                    <input type="submit" name="btnSubmitEditClock" value="Submit">
                    


                </form>
                <?php
               }else{
                   echo 'Please slect a time to edit.';
               }
    ?>
            </div>
            <div id="tab5">
                <table class = "table">
                    <thead>
                        <th>Studdent ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date</th>
                        <th>Clock In</th>
                        <th>Clock Out</th>
                    </thead>
                    <tbody>
                        <?php 
                        
                        foreach($getTutees as $tutees){ 
                            $date = strtotime($tutees['studClockIn']);
                            $printDate = date("m/d/y", $date);
                            $intime = strtotime($tutees['studClockIn']);
				            $printInTime = date("g:i:a", $intime);
				            $outTime = strtotime($tutees['studClockOut']);
				            $printOutTime = date("g:i:a", $outTime);
				            
                        echo("<tr>"); 
                        echo("<td>{$tutees['studClockID']}</td>");
                        echo("<td>{$tutees['studFirstName']}</td>");
                        echo("<td>{$tutees['studLastName']}</td>");
                        echo("<td>$printDate</td>");
                        echo("<td>$printInTime</td>");
                        echo("<td>$printOutTime</td>");
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
    echo "<center><img src='../images/you_shall_not_pass.jpg' alt='You shall not pass' style='width:304px;height:275px'></center>";
    echo "<center><a href=\"../index.php\">Return Home</a></center>";
    }
    
    include '../includes/_footer.php'; 
    ?>
