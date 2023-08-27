<?php include('partials/menu.php');   ?>
<?php
        if(isset($_GET['id']))
        {
           // echo "Getting the data";
           $id= $_GET['id'];
        $sql2="SELECT * FROM tbl_food WHERE id=$id";
        $res2=mysqli_query($conn , $sql2);
       
        $count=mysqli_num_rows($res2);
              if($count==1)
                 {
                  //echo "Admin Available";   
                 $row2=mysqli_fetch_assoc($res2);

                $title=$row2['title'];
                $description=$row2['description'];
                $price=$row2['price'];
                $current_image=$row2['image_name'];
                $current_category=$row2['category_id'];
                $featured=$row2['featured'];
                $active=$row2['active'];
                }
            else 
          {
              $_SESSION['no-category-found']="<div class='error'>Category not Found.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        }
    
    else 
    {
        
      header('location:'.SITEURL.'admin/manage-food.php');
  }     
?>
       <div class="main-content">
        <div class="wrapper">
        <h1>Update Food</h1>

     <br><br>
     <form action="" method="POST" enctype="multipart/form-date">
     <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td>
            <input type="text" name="title" value="<?php echo $title; ?>">
            </td>
        </tr>
        <tr>
            <td>Description: </td>
            <td>
            <textarea name="description" cols="30" rows="5"  <?php echo $description; ?>></textarea>
            </td>
        </tr>
        <tr>
            <td>Price: </td>
            <td>
            <input type="number" name="price" value= "<?php echo $price; ?>" >
            </td>
        </tr>
        <tr>
            <td>CurrentImage: </td>
            <td>
                <?php
                      if($current_image!="")
                      {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px" height="150px">
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
            <td>Select New Image: </td>
            <td>
            <input type="file" name="image" >
            </td>
        </tr>
        <tr>
            <td>Category </td>
            <td>
                <select name="category">
                    <?php
                       $sql="SELECT * FROM tbl_categories WHERE active='yes'";
                       $res=mysqli_query($conn,$sql);
                       $count=mysqli_num_rows($res);
                       if($count>0)
                       {
                        while($row=mysqli_fetch_assoc($res))
                        {
                        $category_title=$row['title'];
                        $category_id=$row['id'];
                        ?>
                        <option <?php if($current_category==$category_id){ echo "selected";}  ?> value="<?php echo $category_id;   ?>"><?php echo $category_title; ?></option>;
                        <?php
                       }
                    }
                       else
                       {
                            echo "<option value='0'>Category Not Avaliable.</option>";
                       }
                    

                    ?>
                </select>
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
            <input type="submit" name="submit" value="Update food" class="btn-secondary">
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
   $description=$_POST['description'];
   $price=$_POST['price'];
   $current_image=$_POST['current_image'];
   $category=$_POST['category'];
   $featured=$_POST['featured'];
   $active=$_POST['active'];
   //2.updating new image if selected
if(isset($_FILES['image']['name']))
{
   $image_name=$_FILES['image']['name'];
   //check whether img is available or not
   if($image_name != "")
   {
         //Image avaliable
    
         //uplose a new image 
         $ext=end(explode('.',$image_name));

//rename the image
$image_name="Food-Name-".rand(0000,9999).'.'.$ext;//


$src_path=$_FILES['image']['tmp_name'];

$dest_path="../images/food/".$image_name;
//finally uplode the image
$upload=move_uploaded_file($src_path, $dest_path);
//check ehether the image is uploded or not
//and if the image is not uploaded then we will stop the process
if($upload==false)
{
    $_SESSION['upload']="<div class='error'>Failed to uplode Image.</div>";
    //redirect
    header('location:'.SITEURL.'admin/add-food.php');
    //stop the process
    die();
}
         //Removw the current image
         if($current_image !="")
         {
            $remove_path="../images/food/".$current_image;
            $remove=unlink($remove_path);
            //check whether img is remove or notot 
            //if fail to remove display mesage and stop process 
            if($remove==false)
            {
                $_SESSION['remove-failed']="<div class='error'>Failed to remove current img</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
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
   $sql3="UPDATE tbl_food SET
   title='$title',
   description='$description',
   price=$price,
   image_name='$image_name',
   category_id='$category',
   featured='$featured',
   active='$active'
   WHERE id=$id
   ";
   //Execute the query
   $res3=mysqli_query($conn,$sql3);
   //redirect page
   if($res3==TRUE)
{
$_SESSION['update']="<div class='success'> Updated Successfully.</div>";
//rdirect to manage admin page
header('location:'.SITEURL.'admin/manage-food.php');
}
else
{
    $_SESSION['update']="<div class='error'> Failed to Updated .</div>";
    //rdirect to manage admin page
    header('location:'.SITEURL.'admin/manage-food.php');
    }
}

?>
</div>
</div>
<?php include('partials/footer.php');   ?>






