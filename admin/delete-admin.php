<?php
// incluse constant.php file here
include('../config/constant.php');
//get the id of Admin to be deleted
 $id= $_GET['id'];

 //Create SQL Queary to Delete Admin
 $sql="DELETE FROM tbl_admin WHERE id=$id";

 //Execute a queary
 $res=mysqli_query($conn,$sql);

 if($res==true)
 {
     //Query executed successfully
    // echo "Admin deleted";
    $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
    //redirect
    header('location:'.SITEURL.'admin/manage-admin.php');
 }
 else
 {
    //echo "Failed to Delete Admin"; 
    $_SESSION['delete']="<div class='error'>Failed to  Delete Admin.Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
 }
 

 //Redirect to mange Admin page with meassage(Success/error)
?>