<?php
session_start();


include('../includes/_header.php');
echo "you have been logged out! <br><a href='login.php'>Login Page</a> ";
include('../includes/_footer.php');
session_destroy();

?>