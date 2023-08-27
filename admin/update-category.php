<?php include('partials/menu.php');   ?>
       <div class="main-content">
        <div class="wrapper">
        <h1>Update Category</h1>

     <br><br>

     <?php
        if(isset($_GET['id']))
        {
           // echo "Getting the data";
           $id= $_GET['id'];
        $sql="SELECT * FROM tbl_categories WHERE id=$id";
        $res=mysqli_query($conn , $sql);
       
        $count=mysqli_num_rows($res);
              if($count==1)
                 {
                  //echo "Admin Available";   
                 $row=mysqli_fetch_assoc($res);

                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
                }
            else 
          {
              $_SESSION['no-category-found']="<div class='error'>Category not Found.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        }
    
    else 
    {
        
      header('location:'.SITEURL.'admin/manage-category.php');
  }     
?>
     <form action="" method="POST" enctype="multipart/form-date">
     <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td>
            <input type="text" name="title" value="<?php echo $title; ?>">
            </td>
        </tr>
        <tr>
            <td>CurrentImage: </td>
            <td>
                <?php
                      if($current_image!="")
                      {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                            <?php
                      }
                      else
                      {
                            echo "<div class='error'>Image Not Added.</div>";
                      }
                ?>
                
            </td>
        </tr>

        <tr>
            <td>New Image: </td>
            <td>
            <input type="file" name="image" value="">
            </td>
        </tr>
        <tr>
            <td>Featured: </td>
            <td>
            <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

            <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
            </td>
        </tr>
        <tr>
            <td>Active: </td>
            <td>
            <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
            </td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image;    ?>">
                <input type="hidden" name="id" value="<?php echo $id;    ?>">
            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
            </td>
        </tr>
        
     </table>
     </form>
<?php
if(isset($_POST['submit']))
{
   // echo  "Clicked";
   $id=$_POST['id'];
   $title=$_POST['title'];
   $current_image=$_POST['current_image'];
   $featured=$_POST['featured'];
   $active=$_POST['active'];
   //2.updating new image if selected
if(isset($_FILES['image']['name']))
{
   $current_image=$_FILES['image']['name'];
   //check whether img is available or not
   if($image_name != "")
   {
         //Image avaliable
    
         //uplose a new image 
         $ext=end(explode('.',$image_name));

//rename the image
$image_name="Food_Category_".rand(000,999).'.'.$ext;//


$source_path=$_FILES['image']['tmp_name'];

$destination_path="../images/category/".$image_name;
//finally uplode the image
$uplode=move_uploaded_file($source_path, $destination_path);
//check ehether the image is uploded or not
//and if the image is not uploaded then we will stop the process
if($uplode==false)
{
    $_SESSION['uplode']="<div class='error'>Failed to uplode Image.</div>";
    //redirect
    header('location:'.SITEURL.'admin/add-category.php');
    //stop the process
    die();
}
         //Removw the current image
         if($current_image !="")
         {
            $remove_path="../images/category/".$current_image;
            $remove=unlink($remove_path);
            //check whether img is remove or notot 
            //if fail to remove display mesage and stop process 
            if($remove==false)
            {
                $_SESSION['failed-remove']="<div class='error'>Failed to remove current img<div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }

         }
   }
   else
   {
      $image_name=$current_image;
   }
}
else
{
    $image_name=$current_image;
}
   //3.Update the database
   $sql2="UPDATE tbl_categories SET
   title='$title',
   image_name='$image_name',
   featured='$featured',
   active='$active'
   WHERE id=$id
   ";
   //Execute the query
   $res2=mysqli_query($conn,$sql2);
   //redirect page
   if($res2==TRUE)
{
$_SESSION['update']="<div class='success'> Updated Successfully.</div>";
//rdirect to manage admin page
header('location:'.SITEURL.'admin/manage-category.php');
}
else
{
    $_SESSION['update']="<div class='error'> Failed to Updated .</div>";
    //rdirect to manage admin page
    header('location:'.SITEURL.'admin/manage-category.php');
    }
}

?>
</div>
</div>
<?php include('partials/footer.php');   ?>






