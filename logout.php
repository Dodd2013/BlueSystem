<?php 
session_start();
session_unset();
session_destroy();
echo "Logout success!<a href='login.php'>Click here to Login!<a/>";
?>