<?php
session_start();

unset($_SESSION["nameoremal"]);
unset($_SESSION["password1"]); 
unset($_SESSION["password"]);   
unset($_SESSION["name"]); 
unset($_SESSION["bloodType"]); 

header("Location:home.php");
?>