<?php include('../config/constant.php');   ?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1> <br><br>

            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>
            <br><br>
            <!-- Login Form Starts Here-->
              <form action="" method="POST" class="text-center">
                  Username: <br>
                  <input type="text" name="username" placeholder="Enter Username"> <br><br>
                  Password: <br>
                  <input type="password" name="password" placeholder="Enter Password"> <br><br>
                  <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
              </form>
             <!-- Login Form Ends Here-->

            <p class="text-center">Create By- <a href="www.nikitakhumkar.com">Nikita,Nidhi ,vaishnavi,Dnyaneshwari</a></p>
        </div>
    </body>
</html>
<?php
//Check whetehr the submit button is clicked or not
if(isset($_POST['submit']))
{
     $username=$_POST['username'];
     $password=md5($_POST['password']);

     //sql qurey to check wheteher the user are
     $sql= "SELECT*FROM tbl_admin WHERE username='$username' AND password='$password'";
      //execute the query
      $res=mysqli_query($conn,$sql);

      $count=mysqli_num_rows($res);
    if($count==1)
    {
     $_SESSION['login']="<div class='success'>Login Successful.</div>";
     $_SESSION['user']=$username;
     header('location:'.SITEURL.'admin/');
     //$row=mysqli_fetch_assoc($res);

     
    }
    else 
    {
        $_SESSION['login']="<div class='error text-center' >Username and Password did not match.</div>";
     header('location:'.SITEURL.'admin/login.php');
       // header('location:'.SITEURL.'admin/manage-admin.php');
    }

}
?>