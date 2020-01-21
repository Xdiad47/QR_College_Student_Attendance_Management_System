<?php
include 'connect.php';
session_start();
if(!isset($_SESSION['email'])|| ($_SESSION['email']=='') and ($_SESSION['id'])|| ($_SESSION['id']=='') and ($_SESSION['user'])|| ($_SESSION['user']=='') )
{
 
 header("Location:forget.php");
}
else {
    $id= $_SESSION['id'] ;
    $email=$_SESSION['email'];
    $user=$_SESSION['user'];
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <title>Forget Password</title>
    <link href="css/style.css" rel="stylesheet">
  ` <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
   
  </head>
  <body class="app flex-row align-items-center">
      <div class="container" >
	
      <div class="row justify-content-center" style="background-color: scrollbar;">
        <div class="col-md-6">
          <div class="card-group">
            <div class="card p-4" style="background-color: navy;">
                <form method="POST" action="">
                <div class="card-body" >
                    <div class="input-group mb-3">
                  
                  
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>
                        <input class="form-control" type="text" placeholder="Enter Your OTP That sent to your mail" name="otp" required >
                        <button class="btn btn-primary px-4" type="submit" name="confirm">Verify</button>
                        <?php
                          if(isset($_POST['confirm'])){
                             $otp=$_POST['otp'];
                              switch ($user) {
                              case 1:
                                  $sql = "SELECT * FROM admin_info WHERE otp = '$otp'";
                                   $res = mysqli_query($conn, $sql);
                                    $row=mysqli_num_rows($res);
                                    if($row == 1){
                                        $r = mysqli_fetch_assoc($res);
                                        $pass = base64_decode($r['password']);
                                        $email=$_SESSION['email'];
                                        $subject = "Password Recovery";
                                        $message = "Your Password Is : " ."[".$pass."]";
                                        if(mail($email, $subject, $message)){
                                            ?>
                                        }
                                       <script type="text/javascript">
                        
                                            if(confirm("Your Password is Send to Your Email")){
                                                window.location.href="login.php"; 
                                            }  
                                        </script>
                                    <?php
                                        }
                                        else{
                                            echo "Failed to Recover your password, try again";
                                        }
                                    }
                                  break;
                               case 2:
                                   $sql = "SELECT * FROM faculty_info WHERE otp = '$otp'";
                                   $res = mysqli_query($conn, $sql);
                                    $row=mysqli_num_rows($res);
                                    if($row == 1){
                                        $r = mysqli_fetch_assoc($res);
                                        $pass = base64_decode($r['password']);
                                        $email=$_SESSION['email'];
                                        $subject = "Password Recovery";
                                        $message = "Your Password Is : " ."[".$pass."]";
                                        if(mail($email, $subject, $message)){
                                            ?>
                                        }
                                       <script type="text/javascript">
                        
                                            if(confirm("Your Password is Send to Your Email")){
                                                window.location.href="login.php"; 
                                            }  
                                        </script>
                                    <?php
                                        }
                                        else{
                                            echo "Failed to Recover your password, try again";
                                        }
                                    }
                                  break;
                                  default:
                                    echo "Oops Something Went Wrong";  
                            }
                          }
                        ?>
                    </div>
                    
              
            
            </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
   </body>
</html>
<?php
}
?>
