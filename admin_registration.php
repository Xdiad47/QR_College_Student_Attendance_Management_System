<!DOCTYPE html>


<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Admin Registration</title>
    
    <link href="css/style.css" rel="stylesheet">
    
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
      
        <a  href="#"><h2><font color="blue"> Online</font><font color="gold">Attendance</h2></font></font></a>  
      
    </header>
	<div class="app flex-row align-items-center">
<div class="container" id="reg">
    <form method="POST" action="">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mx-4">
            <div class="card-body p-4">
              <h1>Register</h1>
              <p class="text-muted">Create your account</p>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div>
                 <?php
                    include("connect.php");
                    $query = "SELECT * FROM department ";
                    $query = mysqli_query($conn, $query);
                    ?>
                    <select class="form-control" id="ccmonth" name="selectdept">
                        <option value="">Select Department</option>
                 <?php
                    while($row = mysqli_fetch_assoc($query)){
                        $deptid=$row['dept_id'];
                        $deptname=$row['dept_name'];

                        echo '<option value="'.$row['dept_id'].'">'.$row['dept_name'].'</option>';
                    }
                    ?>

                    </select>
              </div>
              
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div>
                  <input class="form-control" type="text" placeholder="Admin name" name="adminname" required >
              </div>
              
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                  <input class="form-control" type="email" placeholder="Email" name="email" required>
              </div>
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div>
                  
                      <label class="col-md-3 col-form-label">Gender</label>
                    
                      <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="inline-radio1" type="radio" value="M" name="gender">
                        <label class="form-check-label" for="inline-radio1">Male</label>
                      </div>
                      <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="inline-radio2" type="radio" value="F" name="gender">
                        <label class="form-check-label" for="inline-radio2">Female</label>
                      </div>

                    
              </div>
              
              
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-lock"></i>
                  </span>
                </div>
                  <input class="form-control" type="password" placeholder="Password" name="pass" required>
              </div>
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-lock"></i>
                  </span>
                </div>
                  <input class="form-control" type="password" placeholder="Repeat password" name="cpass" required>
              </div>
              
              <button name="create" class="btn btn-block btn-success" type="submit">Create Account</button>
              <a href="login.php" class="btn btn-block btn-facebook">Login</a>
            </div>
            <div class="card-footer p-4">
              <div class="row">
                <div class="col-10">
                <?php
                    include ("connect.php");
                    if(isset($_POST['create'])){

                        $dept=$_POST['selectdept'];
                        if(empty($dept)){
                            echo "<p>Please Select atleast one Department</p>";
                        }
                        $name=$_POST['adminname'];
                        if(!preg_match("/^[a-zA-Z ]*$/",$name)){
                            echo "<p>Name should contain only alphabet</p>";
                        }
                        $gender=$_POST['gender'];
                        if(empty($gender)){
                            echo "<p>select your gender</p>";
                        }
                        $email=$_POST['email'];
                        if(!preg_match("/^[0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/",$email)){
                        echo "<p>Please enter correct email</p>";
                        }
                        
                        $pass= base64_encode($_POST['pass']);
                        $cpass= base64_encode($_POST['cpass']);
                        if($pass!=$cpass){
                            echo "<p>Password Did not Match </p>";
                        }
                        else {
                         
                        $sql="INSERT INTO admin_info(admin_name,admin_dept,admin_gen,email,password)VALUES('$name',$dept,'$gender','$email','$pass')";
                        $query=mysqli_query($conn, $sql);
                        if($query){
                            $subject="Registration";
                            $message="You Have Successfully registered";
                            if(mail($email, $subject, $message)){
                                ?>
                           <script type="text/javascript">
                        
                            if(confirm("Register Successfully done")){
                                window.location.href="../index.php"; 
                            }  
                            </script>
                    <?php
                           }
                             

                        
                            
                        }
                        else{
                            ?>
                             <script type="text/javascript">
                        
                            if(confirm("Oops Something went wrong try again!!")){
                                window.location.href="admin_registration.php"; 
                            }  
                            </script>
                            <?php
                            }
                        }
                    }

                    ?>
                 </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    </div>
 </div> 
  </body>
</html>

