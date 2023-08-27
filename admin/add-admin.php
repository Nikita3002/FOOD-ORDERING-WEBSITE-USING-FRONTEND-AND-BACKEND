<?php include('partials/menu.php');   ?>

<div class="main-content">
  <div class="wrapper">
     <h1>Add Admin</h1>
     <br/><br/>
     <?php
          if(isset($_SESSION['add']))//checking whether session set or not
          {
              echo $_SESSION['add'];//displaying session Messange
              unset($_SESSION['add']);//removing session Message
          }
     ?>
     <form action="" method="POST">
         <table class="tbl-30">
             <tr>
                 <td>Full Name</td>
                 <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
             </tr>
             <tr>
                 <td>UserName</td>
                 <td><input type="text" name="username" placeholder="Your User Name"></td>
             </tr>
             <tr>
                 <td>Password</td>
                 <td><input type="password" name="password" placeholder="Your password"></td>
             </tr>
             </tr>
             <tr>
                 <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                 </td>
             </tr>
         </table>
     </form>
  </div>
</div>
<?php include('partials/footer.php');   ?>
<?php 
//process the value from and save it in the database
//Check whether the button is clicked or not
if(isset($_POST['submit']))
{
//Button clicked
//echo "Button Clicked";

//get the data from form
$full_name=$_POST['full_name'];
$username=$_POST['username'];
$password=md5($_POST['password']);

//2.sql query to save the data into database
$sql="INSERT INTO tbl_admin SET
     full_name='$full_name',
     username='$username',
     password='$password'
";
//3.Executing query and saving data into database
$res=mysqli_query($conn,$sql)or die(mysqli_error());
//4.
if($res==TRUE)
{
    //inserted
    //echo "Data Inserted";
    $_SESSION['add']="<div class='success'>Admin Added Successfully</div>";
    //redirect page
    header("location:".SITEURL.'admin/manage-admin.php');
}
else{
    //failed
    //echo "Faile to Insert data";
    $_SESSION['add']="<div class='error'>Failed to Add Admin</div>";
    //redirect page
    header("location:".SITEURL.'admin/add-admin.php');
}

//$res = mysqli_query($conn,$sql) or die(mysqli_error());

}
?>