<?php include('partials/menu.php');   ?>
<div class="main-content">
  <div class="wrapper">
     <h1>Add Category</h1>
     <br/><br/>
     <?php
          if(isset($_SESSION['add']))//checking whether session set or not
          {
              echo $_SESSION['add'];//displaying session Messange
              unset($_SESSION['add']);//removing session Message
          }
          if(isset($_SESSION['uplode']))//checking whether session set or not
          {
              echo $_SESSION['uplode'];//displaying session Messange
              unset($_SESSION['uplode']);//removing session Message
         }
     ?>
     <br><br>
     <!-- Add Category form Start -->
     <form action="" method="POST" enctype="multipart/form-data">
         <table class="tbl-30">
             <tr>
                 <td>Title:</td>
                 <td><input type="text" name="title" placeholder="Category Title"></td>
             </tr>
             <tr>
                 <td>Select Image:</td>
                 <td><input type="file" name="image" ></td>
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
             </tr>
             <tr>
                 <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                 </td>
             </tr>
         </table>
     </form>
      <!-- Add Category form Ends -->
      <?php 
//process the value from and save it in the database
//Check whether the button is clicked or not
if(isset($_POST['submit']))
{
//Button clicked
//echo "Button Clicked";
$title=$_POST['title'];
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
//check whether  the image is selected or not and set the value for image name accordingly
//print_r($_FILES['image']);

//die();
if(isset($_FILES['image']['name']))
{
//Uplode the Image
$image_name=$_FILES['image']['name'];
//uplode img if it is selected
if($image_name!="")
{


//Auto rename our image
//get the extension of our image(jpg,png,etc)
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
}
}
else
{
$image_name="";
}
//sql query

$sql="INSERT INTO tbl_categories SET
     title='$title',
     image_name='$image_name',
     featured='$featured',
     active='$active'
";
//execute the query and save in database
$res=mysqli_query($conn,$sql);
//check data is inserted or not
if($res==true)
{
    //inserted
    //echo "Data Inserted";
    $_SESSION['add']="<div class='success'>Category Added Successfully</div>";
    //redirect page
    header("location:".SITEURL.'admin/manage-category.php');
}
else{
    //failed
    //echo "Faile to Insert data";
    $_SESSION['add']="<div class='error'>Failed to Add Category</div>";
    //redirect page
    header("location:".SITEURL.'admin/manage-category.php');
}
}
?>
</div>
</div>
<?php include('partials/footer.php');   ?>