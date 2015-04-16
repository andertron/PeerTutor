<?php
session_start();

?>
<html>
    <head>
        
    </head>
    
    <body >
        <?php
if($_SESSION['screenName']){
    include('../includes/_adminHeader.php');
    ?>
   
   <?php echo"you logged in " . $_SESSION['screenName'] . " " . " NICE!!! <br><a href='logout.php'>Log out!</a>" ?>
<?php
}else{
    include('../includes/_header.php');
    echo"you must be logged in! <br><a href='login.php'>Login Page</a>";
}
 
?>
        
        
    </body>
</html>




<?php
include ('../includes/_footer.php');
?>