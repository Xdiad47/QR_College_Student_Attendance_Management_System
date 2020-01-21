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
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user"></i>
                    </span>
                  </div>
                  <select name="users" class="form-control" id="ccyear">
                          <option >You Are Admin or Faculty</option>
                          <option value="1">Admin</option>
                          <option value="2">Faculty</option>
                  </select>
                </div>
                    
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                  <input class="form-control" type="email" placeholder="Email" name="email" required>
                </div>  
                <?php
                if(isset($_POST['validate'])){
                    include 'connect.php';
                    $user=$_POST['users'];
                    switch ($user) {
              case 1:
                    $email=$_POST['email'];
                    
                    if(!preg_match("/^[0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/",$email)){
                        echo "<p>Please enter correct email</p>";
                    }
                    else{
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $sql = "SELECT * FROM admin_info WHERE email = '$email'";
                    $res = mysqli_query($conn, $sql);
                    $row=mysqli_num_rows($res);
                    if($row == 1){
		
                        $r = mysqli_fetch_assoc($res);
                        $otp=rand();
                        $to = $r['email'];
                        $f=$r['admin_id'];
                        $subject = "Password Recovery";
                        $message = "Please use this OTP to verifivation  " ."[".$otp."]";
                        //$headers = "From: motoshrai8@gmail.com";
                    if(mail($to, $subject, $message)){
                        $update = "UPDATE admin_info SET otp = '$otp' where admin_id=$f ";
                        if (mysqli_query($conn, $update)) {
                       
                            session_start();
                            $_SESSION['email']=$to;
                            $_SESSION['id']=$f;
                    
                            
                        }
                        else{
                            echo "Failed to Recover your password, try again";
                        }     
                    }
                    else{
                            echo "Failed to Recover your password, try again";
                    }
                }
                }
                break;
                case 2:
                    $email=$_POST['email'];
                    
                    if(!preg_match("/^[0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/",$email)){
                        echo "<p>Please enter correct email</p>";
                    }
                    else{
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $sql = "SELECT * FROM faculty_info WHERE email = '$email'";
                    $res = mysqli_query($conn, $sql);
                    $row=mysqli_num_rows($res);
                    if($row == 1){
		
                        $r = mysqli_fetch_assoc($res);
                        $otp=rand();
                        $to = $r['email'];
                        $f=$r['faculty_id'];
                        $subject = "Password Recovery";
                        $message = "Please use this OTP to verifivation  " ."[".$otp."]";
                        //$headers = "From: motoshrai8@gmail.com";
                    if(mail($to, $subject, $message)){
                        $update = "UPDATE faculty_info SET otp = '$otp' where faculty_id=$f ";
                        if (mysqli_query($conn, $update)) {
                            session_start();
                            $_SESSION['email']=$to;
                            $_SESSION['user']=$user;
                            $_SESSION['id']=$f;
                            header("Location:otp.php");
                        }
                        else{
                            echo "Failed to Recover your password, try again";
                        }     
                    }
                    else{
                            echo "Failed to Recover your password, try again";
                    }
                }
                }
                default:
                       echo "Oops Something Went Wrong"; 
                }
                }
                ?>
              
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit" name="validate">Submit</button>
                  </div>
                  
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
