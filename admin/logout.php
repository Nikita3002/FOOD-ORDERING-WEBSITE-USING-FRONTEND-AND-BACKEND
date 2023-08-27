<?php
//include constants.php for SITEURL
include('../config/constant.php'); 
//1.Destroy the Session
session_destroy(); 
//2.redirect to login page
header('location:'.SITEURL.'admin/login.php');
?>