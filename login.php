 <!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link href="css/style.css" rel="stylesheet">
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
   </head>
  <body class="app flex-row align-items-center">
      <div class="container" >
	
      <div class="row justify-content-center" style="background-color: scrollbar;">
        <div class="col-md-6">
          <div class="card-group">
            <div class="card p-4" style="background-color: navy;">
              <div class="card-body" >
                  <h1><font color="white" >Login</font></h1>
<?php
    include 'connect.php';
    if(isset($_POST['login'])){
    $user=$_POST['users'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $password= base64_encode($pass);
    $s=1;
    switch ($user) {
    case 1: 
        
        $sql="SELECT * FROM admin_info WHERE email='$email' and password='$password'";
        $loginquery=mysqli_query($conn, $sql);
        
          if(!$loginquery)
            {
              echo '<h4><font color="white">Opps! Email or Password Is Incorrect.</font></h4>';
            }
            else {
            
              $row= mysqli_fetch_assoc($loginquery);
              $id=$row['admin_id'];
              $dept=$row['admin_dept'];
              $aname=$row['admin_name'];
              
                session_start();
                $_SESSION["name"]=$aname;
                $_SESSION["dept"]=$dept;
                $_SESSION["id"]= $id;
                header("Location:admin/admin_home.php");
                
            }
        break;
    case 2:
        
        $sql="SELECT * FROM faculty_info WHERE email='$email' and password='$password'";
        $loginquery=mysqli_query($conn, $sql);
        
          if(!$loginquery)
            {
              echo '<h4><font color="white">Opps! Email or Password Is Incorrect.</font></h4>';
            }
            else {
            
              $row= mysqli_fetch_assoc($loginquery);
              $id=$row['faculty_id'];
              $dept=$row['dept'];
              $fcaname=$row['faculty_name'];
              $st=$row['status'];
               if($st==0){
                   echo '<h4><font color="white">Sorry! Your account is Deactivated..</font></h4>';
               } 
               else{
                session_start();
                $_SESSION["name"]=$fcaname;
                $_SESSION["dept"]=$dept;
                $_SESSION["id"]= $id;
                header("Location:faculty_home.php");
               } 
                
            }
        break;
    
    default:
        echo "Your provided details is in correct!!, Please Try Again";
}
    }
    
?>
<form method="POST" action="">

		<div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user"></i>
                    </span>
                  </div>
                  <select name="users" class="form-control" id="ccyear">
                          <option >Login As</option>
                          <option value="1">Admin</option>
                          <option value="2">Faculty</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user"></i>
                    </span>
                  </div>
                  <input class="form-control" type="email" placeholder="Email" name="email">
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>
                  <input class="form-control" type="password" placeholder="Password" name="password">
                </div>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit" name="login">Login</button>
                  </div>
                  <div class="col-6 text-right">
                    <a href="forget.php" class="btn btn-link px-0">Forget Password?</a>
                  </div>
                </div></br>
                 <div>
                        
                  <h1><font color="white" >Sign Up</font></h1>
                  <div class="form-group row-sm-9">
                        
                        <select name="selectuser" class="form-control" id="ccyear">
                          <option >Select Register type</option>
                          <option value="1">Admin</option>
                          <option value="2">Faculty</option>
                          <option value="3">Student</option>
                          
                        </select>
                      </div>
                  <button class="btn btn-primary active mt-3" type="submit" name="register">Register Now!</button>
                       
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
if(isset($_POST['register'])){      
$user=$_POST['selectuser'];
switch ($user) {
    case 1: 
        header("Location:admin_registration.php");
        break; 
    case 2:
        header("Location:faculty_registration.php");
        break;   
           
     case 3:          
         header("Location:deptselect.php");
        break;
    
     default:
        echo "Select One user Type";   
} 
  }
?>