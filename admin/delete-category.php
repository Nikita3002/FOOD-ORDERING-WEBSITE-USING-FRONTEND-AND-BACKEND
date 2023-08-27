<?php
include('../config/constant.php');
 //check Whether the id and image_name
 if(isset($_GET['id']) AND isset($_GET['image_name']))
 {
     $id=$_GET['id'];
     $image_name=$_GET['image_name'];
     if($image_name!="")
     {
         $path="../images/category/".$image_name;
         $remove=unlink($path);
     
     if($remove==false)
     {
        $_SESSION['remove']="<div class='error'>Fail to Remove Category Image.</div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-category.php');
        die();
     }
    }
    $sql="DELETE FROM tbl_categories WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true)
 {
     //Query executed successfully
    // echo "Admin deleted";
    $_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";
    //redirect
    header('location:'.SITEURL.'admin/manage-category.php');
 }
 else
 {
    //echo "Failed to Delete Admin"; 
    $_SESSION['delete']="<div class='error'>Failed to  Delete Category.Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-category.php');
 }
 
 }
 else
 {
    header('location:'.SITEURL.'admin/manage-category.php');
 }
?>