<?php

  session_start();
  ob_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <style>
.error {color: #FF0000;}
</style>
  </head>
<body>
  
<?php
include 'dbconnection.php';
$emailErr =" ";


   
  if(isset($_POST['signup'])){


     if(isset($_GET['token'])){

      $token = $_GET['token'];

      
      $password=mysqli_real_escape_string($con,$_POST['password']);
      $cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);
     
      
    

      $pass=password_hash($password,PASSWORD_BCRYPT);
      $cpass=password_hash($cpassword,PASSWORD_BCRYPT);
       
        if($password === $cpassword){

            $updatequery = "update registration set password = '$pass' where  token = '$token' ";
            $iquery = mysqli_query($con , $updatequery);
         
          if($iquery)
          {
            
             $_SESSION['msg'] = "Your password has been updated";
             header('location:login.php');
              
          }
          else{

             $_SESSION['passmsg'] = "Your Password is not Updated";
             header('location:reset_password.php');
            
        
          }
        }
        else
        {
            $_SESSION['passmsg'] = "Password are not Matching";
            }
    }
    else{
        echo "token not found";
    }
}



?>
           
           <div class="container" >
             <div  class="row content">
             

                 <div class="col-md-6 mb-3">
                     <h2 class="signup-text mb-3">Reset your password</h2>
                     <h5>Enter your new password here</h5>

                     <p>
                     <?php
                     if(isset($_SESSION['passmsg'])){
                         echo $_SESSION['passmsg'];
                     }else{
                        $_SESSION['passmsg'] = "";
                     }
                     ?></p>
                    <form method="POST" action="">
                
                     <div class="form-group"> 
                        <label htmlFor="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="text" name="password"  autoComplete="off" placeholder="New Password" class="form-control" required>
                           
                        </input>
                        <div class="form-group"> 
                        <label htmlFor="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="text" name="cpassword"  autoComplete="off" placeholder="Confirm Password" class="form-control" required>
                           
                        </input>
                       
                     
                     </div>
                     <div class="btn-class">
                     <input type="submit" name="signup"  autoComplete="off"  class="btn-class-form" value="Change password" ></input>
                     </div>
                    </form>
                 </div>

           </div>
    
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>