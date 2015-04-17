<?php
 session_start();
$host="kingjv-capstone-1424418"; // Host name
$username="kingjv"; // Mysql username
$password=""; // Mysql password
$db_name="TutoringDB"; // Database name
$screenName = "";
$type ="";

$tbl_name="tblAdmins"; // Table name
$tbl_name2="tblTutors"; // Table name

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or
die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");



// username and password sent from form
$myusername=$_POST['email'];
$mypassword=md5($_POST['password']);


// To protect MySQL injection (more detail about MySQL injection)
//$myusername = stripslashes($myusername);
//$mypassword = stripslashes($mypassword);
//$myusername = mysql_real_escape_string($myusername);
//$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl_name WHERE AdminEmail='$myusername' and
AdminPassword='$mypassword'";
$result=mysql_query($sql);

$sql2="SELECT * FROM $tbl_name2 WHERE TutorEmail='$myusername' and
TutorPassword='$mypassword'";
$result2=mysql_query($sql2);

$count=mysql_num_rows($result);
$count2=mysql_num_rows($result2);
unset($_SESSION['type']);
$validation = true;
if($count == 1){

while ($row = mysql_fetch_assoc($result)) {
$screenName = $row['AdminFirstName'];
$type = "Admin";

$_role = "Admin";
$_SESSION['role'] = $_role;
$_SESSION['screenName'] = $screenName;  
$_SESSION['type'] = $type;
header("location:/Admin/adminControlPanel.php");

}
$validation = true;
}
 
elseif($count2 == 1){
while ($row2 = mysql_fetch_assoc($result2)) {
$screenName = $row2['TutorFirstName'];
$tutorID = $row2['TutorID'];
$_role = "Tutor";
$type = "Tutor";

$_SESSION['screenName'] = $screenName; 
$_SESSION['role'] = $_role;
$_SESSION['type'] = $type;
$_SESSION['tutorID'] = $tutorID;
header("location:/Admin/tutorControl.php");

}
$validation = true;
}
    

else {
   
//echo "Wrong Username or Password";
$_SESSION['myusername'] = $myusername;
$_SESSION['mypassword'] =$mypassword;
$validation = false;
$_SESSION['validation'] = $validation;

header("location:/Admin/login.php");

}
?>
<?php
