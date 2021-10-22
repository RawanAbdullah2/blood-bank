<?php
session_start();

unset($_SESSION["nameho"]);
unset($_SESSION["password2"]); 
unset($_SESSION["phonenumber"]); 
unset($_SESSION["hospitalid"]); 

header("Location:home.php");
?>