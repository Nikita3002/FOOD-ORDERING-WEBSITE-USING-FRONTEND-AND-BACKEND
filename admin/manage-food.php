<?php include('partials/menu.php');   ?>

<div class="main-content">
<div class="wrapper">
<h1>Manage Food</h1>
<br/><br/>
        <!--Button to add Admin -->
        <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add food</a>
        <br/><br/><br/>

<?php
 if(isset($_SESSION['add']))//checking whether session set or not
 {
     echo $_SESSION['add'];//displaying session Messange
     unset($_SESSION['add']);//removing session Message
}
if(isset($_SESSION['delete']))//checking whether session set or not
 {
     echo $_SESSION['delete'];//displaying session Messange
     unset($_SESSION['delete']);//removing session Message
}
if(isset($_SESSION['upload']))//checking whether session set or not
 {
     echo $_SESSION['upload'];//displaying session Messange
     unset($_SESSION['upload']);//removing session Message
}

if(isset($_SESSION['unauthorize']))//checking whether session set or not
 {
     echo $_SESSION['unauthorize'];//displaying session Messange
     unset($_SESSION['unauthorize']);//removing session Message
}
if(isset($_SESSION['update']))//checking whether session set or not
 {
     echo $_SESSION['update'];//displaying session Messange
     unset($_SESSION['update']);//removing session Message
}
?>

        <table class="tbl-full">
<tr>
     <th>S.N.</th>
     <th>title</th>
     <th>Price</th>
     <th>image</th>
     <th>featured</th>
     <th>Active</th>
     <th>Action</th>

</tr>
<?php
$sql="SELECT * FROM tbl_food";

$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);
$sn=1;
if($count>0)
{
   while($row=mysqli_fetch_assoc($res))
   {
       $id=$row['id'];
       $title=$row['title'];
       $price=$row['price'];
       $image_name=$row['image_name'];
       $featured=$row['featured'];
       $active=$row['active'];
       ?>

<tr>
    <td><?php echo $sn++; ?></td>
    <td><?php echo $title; ?></td>
    <td><?php echo $price; ?></td>
    <td><?php 
           if($image_name=="")
           {
               echo "<div class='error'>Image not Added.</div>";
           }
           else
           {
               ?>
               <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name;  ?>" width="100px">
               <?php
           }
        ?>
    </td>
    
    <td><?php echo $featured; ?></td>
    <td><?php echo $active; ?></td>

    <td>
        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;  ?>" class="btn-secondary">Update Food</a>
        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;  ?>&image_name=<?php echo $image_name  ?>" class="btn-danger">Delete Food</a>
        
    </td>
</tr>


       <?php
       
   }
}
else
{
    //food not added in database
    echo "<tr><td colspan='7' class='error'>Food not added yet.</td></tr>";
}
?>


        </table>
</div>
</div>
<?php include('partials/footer.php');   ?>