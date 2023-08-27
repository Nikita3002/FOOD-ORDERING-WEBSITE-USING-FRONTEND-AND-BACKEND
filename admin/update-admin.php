<?php include('partials/menu.php');   ?>

        <!--Menu Content Section Starts -->
        <div class="main-content">
        <div class="wrapper">
        <h1>Update Admin</h1>
        <br/><br/>
        <?php
        $id= $_GET['id'];
        $sql="SELECT * FROM tbl_admin WHERE id=$id";
        $res=mysqli_query($conn,$sql);
//check whether the query is executed or not
if($res==TRUE)
{
    //count rows
    $count=mysqli_num_rows($res);
    if($count==1)
    {
     //echo "Admin Available";   
     $row=mysqli_fetch_assoc($res);

     $full_name=$row['full_name'];
     $username=$row['username'];
    }
    else 
    {
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
        ?>
        <form action="" method="POST">
         <table class="tbl-30">
             <tr>
                 <td>Full Name</td>
                 <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
             </tr>
             <tr>
                 <td>UserName</td>
                 <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
             </tr>
             
             <tr>
                 <td colspan="2">
                 <input type="hidden"name="id" value="<?php echo $id; ?>" >
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                 </td>
             </tr>
         </table>
     </form>
</div>
</div>
<?php 
//process the value from and save it in the database
//Check whether the button is clicked or not
if(isset($_POST['submit']))
{
//Button clicked
//echo "Button Clicked";

//get the data from form
$id=$_POST['id'];
$full_name=$_POST['full_name'];
$username=$_POST['username'];
//create sql query
$sql="UPDATE tbl_admin SET
     full_name='$full_name',
     username='$username' 
     WHERE id='$id'
";
$res=mysqli_query($conn,$sql);

if($res==TRUE)
{
$_SESSION['update']="<div class='success'>Admin Updated Successfully.</div>";
//rdirect to manage admin page
header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    $_SESSION['update']="<div class='error'>Failed.</div>";
    //rdirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
    }
}

?>
 <?php include('partials/footer.php');   ?>
