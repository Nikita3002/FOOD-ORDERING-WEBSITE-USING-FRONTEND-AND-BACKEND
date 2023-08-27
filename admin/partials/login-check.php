<?php
//Authorization- Access Control
//Check whether the user is logged in or not
if(!isset($_SESSION['user']))//if user session is not set
{
//user is not logged in
//redirect to login page with message
$_SESSION['no-login-message']="<div class='error text-center'>Please logiin to access Admin Panel</div>";
//redirect to login page with message
header('location:'.SITEURL.'admin/login.php');
}
?>