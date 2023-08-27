<?php
include('../config/constant.php');

if(isset($_GET['id']) AND isset($_GET['image_name']))
 {
   // echo "Process ";
   $id=$_GET['id'];
   $image_name=$_GET['image_name'];
   if($image_name!="")
     {
         $path="../images/food/".$image_name;
         $remove=unlink($path);
     
     if($remove==false)
     {
        $_SESSION['upload']="<div class='error'>Fail to Remove Image File.</div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-food.php');
        die();
     }
    }
    $sql="DELETE FROM tbl_food WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true)
 {
     //Query executed successfully
    // echo "Admin deleted";
    $_SESSION['delete']="<div class='success'>Food Deleted Successfully</div>";
    //redirect
    header('location:'.SITEURL.'admin/manage-food.php');
 }
 else
 {
    //echo "Failed to Delete Admin"; 
    $_SESSION['delete']="<div class='error'>Failed to  Delete Food.Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
 }
 
 }
 else
 {
    $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
 }


?>
