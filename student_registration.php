<?php
include 'connect.php';
session_start();
if(!isset($_SESSION["stu_dept"])|| ($_SESSION["stu_dept"]=='') )
{
    header("Location:deptselect.php");
}

else
{
   $dept=$_SESSION["stu_dept"]; 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Student Registration</title>
    
    <link href="css/style.css" rel="stylesheet">
    
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
      
        <a  href="#"><h2><font color="blue"> Online</font><font color="gold">Attendance</h2></font></font></a>  
      
    </header>
      <div class="app flex-row align-items-center">
<div class="container" id="reg">
    <form method="POST" action="register.php">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mx-4">
            <div class="card-body p-4">
              <h1>Register</h1>
              <h4>Student ID:</h4>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div>
                  <input class="form-control" id="text-input" type="text" name="id" maxlength="6" >
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div>
                  <input class="form-control" readonly id="email-input" type="text" name="dept" value="<?php echo $dept; ?>">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div>
                  <input class="form-control" id="email-input" type="text" name="fullname" placeholder="Enter Full Name" required pattern="[a-zA-Z][a-zA-Z\s]*">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div>
                  <?php 
                        
                         $cquery = "Select course_id,course_name from course where dept_id=$dept;";
                          $cexecutequery = mysqli_query($conn, $cquery);
                          ?>
                          <select class="form-control" id="ccmonth" name="course">
                              <option value="">Select Course</option>
                              <?php
                          while($row = mysqli_fetch_assoc($cexecutequery)){
                              $id=$row['course_id'];
                              $name=$row['course_name'];

                              echo '<option value="'.$id.'">'.$name.'</option>';
                          }
                          echo '</select><br>'; 
                      ?>
              </div>
              
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-time"></i>
                  </span>
                </div>
                  <label class="col-md-3 col-form-label" for="date-input">DOB</label>
                  <input class="form-control" id="date-input" type="date" name="date">
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
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div>
                  
                      <label class="col-md-3 col-form-label">Batch</label>
                    
                      <div class="form-check form-check-inline mr-1">
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="form-check-label" for="inline-radio1">From</label>
                        <input class="form-control col-form-label" id="email-input" type="text" name="start" maxlength="4">
                        
                      
                          
                          <label class="form-check-label" for="inline-radio2">To</label>
                          <input class="form-control col-form-label "id="email-input" type="text" name="end" maxlength="4">
                          
                      </div>

                    
              </div>
              
              <input  type="submit" name="create" class="btn btn-block btn-primary"  value="Register">
              
            </div>
            <div class="card-footer p-4">
              <div class="row">
                <div class="col-10">
                        <?php
                            if(isset($_POST['create'])){
                            include ("connect.php");
                                $stdid=$_POST['id'];
                                if(!preg_match("/^[0-9]*$/",$stdid))
                                    {
                                        echo "<p>plese enter valid registration ID number</p>";
                                    }

                                $fullname=$_POST['fullname'];
                                if(!preg_match("/^[a-zA-Z ]*$/",$fullname)){
                                    echo "<p>Name should contain only alphabet</p>";
                                }

                                $department=$_POST['dept'];

                                $course=$_POST['course'];
                                if(empty($course)){
                                    echo "<p>Please Select atleast one course</p>";
                                }

                                $gender=$_POST['gender'];
                                if(empty($gender)){
                                    echo "<p>select your gender</p>";
                                }

                                $date=$_POST['date'];
                                if(empty($date)){
                                    echo "<p>select your date of birth</p>";
                                }

                                $start=$_POST['start'];
                                $end=$_POST['end'];
                                if(!$start>1000 && !$end<2100){
                                    echo "<p>Please Enter correct year</p>";

                                }
                                else{
                                   $batch= $start."".$end;


                                if(empty($date)){
                                    echo "<p>Select Date Of Birth</p>";
                                }
                               else {

                                $sql="INSERT INTO student_info(std_id,std_name,std_dept,std_course,std_batch,std_gender,std_dob)VALUES($stdid,'$fullname',$department,$course,$batch,'$gender','$date')";
                                $query=mysqli_query($conn, $sql);
                                if($query){
                                     session_start();
                                    $_SESSION['regid']=$stdid;

                                    header("Location:qrcode.php");

                                }
                                else{
                                    echo "<p>Oops something went wrong</p>";
                                }
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

<?php
}
?>