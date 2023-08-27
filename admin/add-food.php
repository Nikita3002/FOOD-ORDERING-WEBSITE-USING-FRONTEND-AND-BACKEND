<?php include('partials/menu.php');   ?>

<div class="main-content">
  <div class="wrapper">
     <h1>Add Food</h1>
     <br><br>
     <?php
          if(isset($_SESSION['upload']))//checking whether session set or not
          {
              echo $_SESSION['upload'];//displaying session Messange
              unset($_SESSION['upload']);//removing session Message
         }
     ?>
     <form action="" method="POST" enctype="multipart/form-data">
         <table class="tbl-30">
             <tr>
                 <td>Title:</td>
                 <td><input type="text" name="title" placeholder="Title of the Food"></td>
             </tr>
             <tr>
                 <td>Description:</td>
                 <td><textarea name="description" id="" cols="30" rows="5" placeholder="Description of the Food"></textarea></td>
             </tr>
             <tr>
                 <td>Price:</td>
                 <td><input type="number" name="price"></td>
             </tr>
             <tr>
                 <td>SelectImage:</td>
                 <td><input type="file" name="image" ></td>
             </tr>
             <tr>
                 <td>Category:</td>
                 <td><select name="category">
                       
                 <?php
                //1.create SQL queryto get all active categories
                $sql="SELECT * FROM tbl_categories WHERE active='Yes'";
                //Exwcute query
                $res=mysqli_query($conn,$sql);
                //rows to check wheteher we have
                $count=mysqli_num_rows($res);
                //if count is greater than zero
                if($count>0)
                {
                   //we have categories
                   while($row=mysqli_fetch_assoc($res))
                   {
                       //get the dwtails of categories
                       $id=$row['id'];
                       $title=$row['title'];
                       ?>
                       <option value="<?php echo $id;  ?>"><?php echo $title;    ?></option>
                       <?php
                        
                   }
                }
                else
                {
                    //we do not have categories
                    ?>
                    <option value="0">No Category Found</option>
                    <?php
                }
                //2.Display drop down

                 ?>

                 </select></td>
             </tr>
             <tr>
                 <td>Featured:</td>
                 <td>
                <input type="radio" name="featured" value="Yes">Yes
                 <input type="radio" name="featured" value="No">No
                </td>
             </tr>
             <tr>
                 <td>Active:</td>
                 <td>
                     <input type="radio" name="active" value="Yes">Yes
                     <input type="radio" name="active" value="No">No
                </td>
             </tr>
             
             <tr>
                 <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                 </td>
             </tr>
         </table>
     </form>

     <?php
     //Check whether the button is Clicked or not
     if(isset($_POST['submit']))
     {
         //echo "Clicked ";
         //1.Get the Data from form
              $title=$_POST['title'];
              $description=$_POST['description'];
              $price=$_POST['price'];
              $category=$_POST['category'];

              if(isset($_POST['featured']))
              {
                  $featured=$_POST['featured'];
              }
              else
              {
                  $featured="No";
              }
              if(isset($_POST['active']))
              {
                  $active=$_POST['active'];
              }
              else
              {
                  $active="No";
              }
            
            
         //2.Uplode the Image if Select
         if(isset($_FILES['image']['name']))
         {
            $image_name=$_FILES['image']['name'];
            if($image_name!="")
              {
                $ext=end(explode('.',$image_name));
                $image_name="Food-Name-".rand(0000,9999).'.'.$ext;
                $src=$_FILES['image']['tmp_name'];

             $dst="../images/food/".$image_name;
            //finally uplode the image
             $upload=move_uploaded_file($src, $dst);

             //check whether uplode or not
             if($upload==false)
                    {
                     $_SESSION['upload']="<div class='error'>Failed to uplode Image.</div>";
                     //redirect
                      header('location:'.SITEURL.'admin/add-food.php');
                       //stop the process
                       die();
                    }

              }
            }
         else
        {
          $image_name="";
        }

         //3.Insert into database
        $sql2="INSERT INTO tbl_food SET 
        title='$title',
        description='$description',
        price=$price,
        image_name='$image_name',
        category_id='$category',
        featured='$featured',
        active='$active'
        ";
        $res2=mysqli_query($conn,$sql2);
        
               //4.Redirect 
        if($res2 == true)
        {
           $_SESSION['add']="<div class='success'>Food Added Successfully.</div>";
           header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['add']="<div class='error'>Failed to add food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
  
     }
      
     ?>
     </div>
</div>
<?php include('partials/footer.php');   ?>



