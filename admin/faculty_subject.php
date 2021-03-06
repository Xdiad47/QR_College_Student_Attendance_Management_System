<?php
include 'connect.php';
session_start();
if(!isset($_SESSION['name'])|| ($_SESSION['name']=='') and ($_SESSION['dept'])|| ($_SESSION['dept']=='') and ($_SESSION['id'])|| ($_SESSION['id']=='') )
{
 
 header("Location:../index.php");
}
else {
    $id= $_SESSION['id'] ;
 $name=$_SESSION['name'];
 $dept=$_SESSION['dept'];
?> 
<!DOCTYPE html>


<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <title> Set Faculty Subject</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link href="css/style.css" rel="stylesheet">
    
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
       <a href="#"><h2><font color="blue"> Online</font><font color="gold">Attendance</h2></font></font></a>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
              <li class="nav-item "><a class="nav-link " href="admin_home.php">HOME</a></li>
              <li class="nav-item "><a class="nav-link " href="subject.php"> Subject</a></li>
              <li class="nav-item "><a class="nav-link " href="course.php"> Program</a></li>
              <li class="nav-item "><a class="nav-link " href="faculty.php">Manage Faculty</a></li>
              <li class="nav-item btn-primary "><a class="nav-link " href="faculty_subject.php"> Initialization</a></li>
              <li class="nav-item "><a class="nav-link " href="report.php"> Report</a></li>
              
              <li class="nav-item "><a class="nav-link " href="../logout.php"> Logout</a></li>
          </ul>
        </nav>  
      </div>
      <main class="main">
          <ol class="breadcrumb">
              
          <li class="breadcrumb-item">
              <strong>Admin:&nbsp;&nbsp;<?php echo $name; ?></strong>
          </li>
          <li class="breadcrumb-item">
              <strong>Department:&nbsp;&nbsp;<?php 
              $query = "SELECT * FROM department where dept_id=$dept ";
              $query = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($query);
              $deptname=$row['dept_name'];
              echo $deptname;
              ?>
              </strong>  
          </li>
          </ol>
          
        <div class="container-fluid">
          <div class="animated fadeIn">
              	<div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <strong>Faculty:&nbsp;&nbsp;<?php echo $name; ?></strong>
          </li>
                  </ol>
                  <div class="card-body">
                    
                      <form method="POST" action="">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                      
                      <tbody>
                        
            
                        <tr>
                            <td>
                                <?php
                                    
                                    $query = "SELECT * FROM faculty_info where dept=$dept ";
                                    $query = mysqli_query($conn, $query);
                                    ?>
                                    <select class="form-control" id="ccmonth" name="faculty">
                                        <option value="">Select Faculty</option>
                                <?php
                                    while($row = mysqli_fetch_assoc($query)){
                                        
                                        

                                        echo '<option value="'.$row['faculty_id'].'">'.$row['faculty_name'].'</option>';
										}
                                    ?>

                                    </select>
                            </td>
                            <td >
                                <?php
                                    
                                    $query = "SELECT distinct std_batch FROM student_info where std_dept=$dept ";
                                    $query = mysqli_query($conn, $query);
                                    ?>
                                    <select class="form-control" id="ccmonth" name="batch">
                                        <option value="">Select Batch</option>
                                <?php
                                    while($row = mysqli_fetch_assoc($query)){
                                        $stb=$row['std_batch'];
                                        

                                        echo '<option value="'.$row['std_batch'].'">'.$row['std_batch'].'</option>';
										}
                                    ?>

                                    </select>
                            </td>
                            <td>
                                <?php
                                $query = "SELECT * FROM course where dept_id=$dept";
                                $result=mysqli_query($conn, $query);
                                ?>
                                <select class="form-control" id="ccmonth" name="course">
                                        <option value="">Select Course</option>
                                <?php
                                    while($row = mysqli_fetch_assoc($result)){
                                        
                                    echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';
                                      }
                                    ?>

                                </select>
                            </td>
                            
                            <td >
                                <?php
                                    
                                    $query = "SELECT sub_id,sub_name FROM subject,course where course.course_id=course.dept_id=$dept";
                                    $query = mysqli_query($conn, $query);
                                    ?>
                                    <select class="form-control" id="ccmonth" name="subject">
                                        <option value="">Select Subject</option>
                                <?php
                                    while($row = mysqli_fetch_assoc($query)){
                                        
                                    echo '<option value="'.$row['sub_id'].'">'.$row['sub_name'].'</option>';
                                      }
                                    ?>

                                    </select>
                            </td>
                            
                                        <td > 
                                
                                <select class="form-control" id="ccmonth" name="assignyear" required>
                                        
                                    <?php
                                        for($i=date("Y"); $i>=2010 ;$i--)
                                        {
                                    ?><option value="<?php  echo $i; ?>"><?php  echo $i; ?></option>
                                         <?php
                                         
                                        }?>
                                </select> </td>
                            <td >
                                <select class="form-control" id="ccmonth" name="session">
                                        <option value="">Session</option>
                                         <option value="1">Autumn</option>
                                          <option value="2">Spring</option>
                                </select>       
                            </td>
                        </tr>
                      </tbody>
                    </table>
                          <button class="btn btn-sm btn-primary" type="submit" name="save" >
                      <i class="fa fa-dot-circle-o"></i>Save Subject</button>
                      </form>
                        <?php
                        if(isset($_POST["save"]))
{  
   $faculty= $_POST["faculty"];
   $subject= $_POST["subject"];
   $batch= $_POST["batch"];
    $assignyear=$_POST["assignyear"];
    $course=$_POST["course"];

   $session= $_POST["session"];
   
 if(mysqli_query($conn, "insert into faculty_subject values(@, $faculty,$course, $subject, $batch, $assignyear, $session)"))
 {
         echo "Subject assigned successfully";
 }
 else{
     echo "Failed";   
    
}}
?>


                </div>
                </div>
              </div>
                </div>
          </div>
        </div>
          
        
      </main>
      
    </div>
    
    </body>
</html>
<?php
}

?>

