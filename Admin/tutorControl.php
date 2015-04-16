<?php
include '../includes/tutorHeader.php';
include( "../DataUtil/common.inc.php");
include '../DataUtil/DataAccess.inc.php';


$da = new DataAccess($link);
$punchTable=$da->get_punch_table();
$tutorID = $_SESSION['tutorID'];



$studID = 0;
$studFirstName = "";
$studLastName = "";
$time_in = "";
$time_out = "";
$tut_time_in = "";
$tut_time_out = "";

if(isset($_POST['btnTutClockIn'])){

     
    $tut_error_messages = array();
    
    if(isset($_POST['tutorID'])){
        if(empty($_POST['tutorID'])){
            $tut_error_messages['tutorID'] = "Tutor ID is a required field";
        }else{
        $time_in = date('Y-m-d H:i:s');
        }
    }
}
if(isset($_POST['btnTutClockOut'])){
    $time_in = $_POST['tutClockIn'];
     $time_out = date('Y-m-d H:i:s');  
}


if(isset($_POST['btnStudClockIn'])){
$time_in = date('Y-m-d H:i:s');    
$studID = (int)$_POST['studentID'];
$studFirstName = $_POST['firstName'];
$studLastName = $_POST['lastName'];

$error_messages = array();

      if(isset($_POST['studentID'])){
        if(empty($_POST['studentID'])){
          $error_messages['studentID'] = "Student ID is a required field";
        }
      }
      if(isset($_POST['firstName'])){
        if(empty($_POST['firstName'])){
          $error_messages['firstName'] = "Student first name is a required field";
        }
      }
      if(isset($_POST['lastName'])){
        if(empty($_POST['lastName'])){
          $error_messages['lastName'] = "Student last name is a required field";
        }
      }
     
      
  if(empty($error_messages)){
    $da->insert_punch_table_data($studID, $studFirstName, $studLastName, $time_in);
    ?>
     <meta http-equiv="refresh" content="0">
     <?php
    // var_dump($studID, $studLastName, $studFirstName, $time_in);
    
  }

}
if(isset($_POST['btnStudClockOut'])){
$time_out = date('Y-m-d H:i:s');    
$studID = (int)$_POST['studentID'];


$error_messages = array();


      if(isset($_POST['studentID'])){
        if(empty($_POST['studentID'])){
          $error_messages['studentID'] = "Student ID is a required field";
        }
}
  if(empty($error_messages)){
     
    $da->update_punch_table_data($time_out, $studID);

    var_dump($studID, $time_out);
    
  }
}
?>
<html>
    





</script>
    
<div class="top-title-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="page-info">
                                    <h1 class="h1-page-title">Tutor Control</h1>


                                    <!-- BreadCrumb -->
                                    <div class="breadcrumb-container">
                                        <ol class="breadcrumb">
                                            <li>
                                                <a href="">Tutor Home</a>
                                            </li>
                                            <li class="active">Home</li>
                                        </ol>
                                    </div>
                                    <!-- BreadCrumb -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--.top wrapper end -->

            <div class="loading-container">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>


            <div class="content-wrapper hide-until-loading"><div class="body-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 animated" data-animtype="flipInY"
                                 data-animrepeat="0"
                                 data-speed="1s"
                                 data-delay="0.5s">
                                <h2 class="h2-section-title">Clock In</h2>

                                <div class="i-section-title">
                                    <i class="icon-users-outline">

                                    </i>
                                </div>

                                <div class="space-sep20"></div>
                            </div>            
                        </div>

                        <div class="row">
                            
                            <?php
                            if(isset($tut_error_messages['tutorID'])){
                            echo("<font color='red'> * Tutor ID is a required field.</font><br>");
                            }
                            ?>
                            <Table class="table"border = "1">
                                <thead>
                                <th>Tutor ID</th>
                                <th></th>
                                <th></th>

       
                                </thead>
                                <form method ="POST">
                                <tbody>
                                    <tr>
                                    <td><input type="text" name="tutorID"/ readonly value="<?php echo ($tutorID) ?>"/></td>
                                    <td><input type = "submit" name = "btnTutClockIn" value = "Clock In"><input type="text" name="tutClockIn "value = "<?php echo ($time_in)?>" /></td>
                                    <td><input type = "submit" name = "btnTutClockOut" value="Clock Out"><input type="text"  value = "<?php echo ($time_out)?>"/></td>
                                    </tr>
                                    <?php
              
                                    ?>
                                </tbody>
                                </form>
                              </Table>   
                            
                 
                           <table class="table" id="studTable" border="1">

                                 <thead>
                                <th>Student ID</th>
                                <th>Student First Name</th>
                                <th>Student Last Name</th>
                                <th></th>
                                <th></th>
      
                                </thead>
                                   <form method ="POST">   
                                    <tr>
                                    <td><input type="text" name="studentID"/></td>
                                    <td><input type="text" name="firstName"/></td>
                                    <td><input type="text" name="lastName"/></td>
                                    <td><input type = "submit" name = "btnStudClockIn" value = "Clock In"></td>
                                    <td><input type = "submit" name = "btnStudClockOut" value="Clock Out"></td>
                                    </tr>
                                </form>
                                  <tbody>
                                    <?php
                                        foreach($punchTable as $punch){
                                            echo("<tr>");
                                            echo("<td>{$punch['studClockID']}</td>");
                                            echo("<td>{$punch['studFirstName']}</td>");
                                            echo("<td>{$punch['studLastName']}</td>");
                                            echo("<td>{$punch['studClockIn']}</td>");
                                            if(!$punch['studClockOut'] = null){
                                            echo("<td>{$punch['studClockOut']}</td>");
                                                
                                            }
                                            echo("</tr>");
                                        }
                                    ?>
                                </tbody>
                                 
                              </table>    
                           
                            
                            

                            
            </div><!--.content-wrapper end -->
            </html>
            
<?php
unset($_SESSION['myusername']);
include '../includes/_footer.php';
?>