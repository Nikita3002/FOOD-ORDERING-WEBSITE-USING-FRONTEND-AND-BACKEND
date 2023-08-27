<?php include('partials/menu.php');   ?>

<div class="main-content">
<div class="wrapper">
<h1>Manage Category</h1>
<br/><br/>
<?php
          if(isset($_SESSION['add']))//checking whether session set or not
          {
              echo $_SESSION['add'];//displaying session Messange
              unset($_SESSION['add']);//removing session Message
          }
          if(isset($_SESSION['remove']))//checking whether session set or not
          {
              echo $_SESSION['remove'];//displaying session Messange
              unset($_SESSION['remove']);//removing session Message
          }
          if(isset($_SESSION['delete']))//checking whether session set or not
          {
              echo $_SESSION['delete'];//displaying session Messange
              unset($_SESSION['delete']);//removing session Message
          }
          if(isset($_SESSION['no-category-found']))//checking whether session set or not
          {
              echo $_SESSION['no-category-found'];//displaying session Messange
              unset($_SESSION['no-category-found']);//removing session Message
          }
          if(isset($_SESSION['update']))//checking whether session set or not
          {
              echo $_SESSION['update'];//displaying session Messange
              unset($_SESSION['update']);//removing session Message
          }
          if(isset($_SESSION['uplode']))//checking whether session set or not
          {
              echo $_SESSION['uplode'];//displaying session Messange
              unset($_SESSION['uplode']);//removing session Message
          }
          if(isset($_SESSION['failed-remove']))//checking whether session set or not
          {
              echo $_SESSION['failed-remove'];//displaying session Messange
              unset($_SESSION['failed-remove']);//removing session Message
          }

     ?>
     <br><br>
        <!--Button to add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br/><br/><br/>
        <table class="tbl-full">
<tr>
     <th>S.N.</th>
     <th>Tittle</th>
     <th>Image</th>
     <th>Featured</th>
     <th>Active</th>
     <th>Actions</th>
</tr>
<?php
   $sql="SELECT * FROM tbl_categories";

//execute query
$res=mysqli_query($conn,$sql);

//count rows
$count=mysqli_num_rows($res);

//create sr no variale 
$sn=1;

//check whether we have data in database
if($count>0)
{
//we have data
while($row=mysqli_fetch_assoc($res))
  {
$id=$row['id'];
$title=$row['title'];
$image_name=$row['image_name'];
$featured=$row['featured'];
$active=$row['active'];
?>
                 <tr>
                     <td><?php echo $sn++; ?></td>
                     <td><?php echo $title; ?></td>

                     <td>
                       <?php 
                       if($image_name!=="")
                       {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                        <?php 
                       }
                       else
                       {
                             echo"<div class='error'>Image not Added.</div>";
                       }
                       ?>
                    </td>

                     <td><?php echo $featured; ?></td>
                     <td><?php echo $active; ?></td>
                     <td>
       
        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?> "class="btn-secondary">Update Category</a>
        
        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name="<?php echo $image_name; ?> class="btn-danger">Delete Category</a>
        
    </td>
</tr>
<?php
  }
}
else
{
//we dont 
?>
<tr>
    <td colspan="6"><div class="error">NO category Added.</div></td>
</tr>
<?php
}


?>

 </table>
</div>
</div>
<?php include('partials/footer.php');   ?>