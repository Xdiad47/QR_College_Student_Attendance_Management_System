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
    <base href="./../">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <title>Admin </title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/style.css" />
  
    
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
              <li class="nav-item "><a class="nav-link " href="admin/admin_home.php">HOME</a></li>
              <li class="nav-item "><a class="nav-link " href="admin/subject.php"> Subject</a></li>
              <li class="nav-item btn-primary"><a class="nav-link " href="admin/course.php"> Program</a></li>
              <li class="nav-item "><a class="nav-link " href="admin/faculty.php">Manage Faculty</a></li>
              <li class="nav-item "><a class="nav-link " href="admin/faculty_subject.php"> Initialization</a></li>
              <li class="nav-item "><a class="nav-link " href="admin/report.php"> Report</a></li>
              
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
		  <div class="card">
                  <div class="card-header">
                    <strong>Enter New Course</strong></div>
                  <div class="card-body">
                    <form class="form-inline" action="" method="POST">
                      <div class="form-group">
                        <label for="exampleInputName2">Subject</label>&nbsp;&nbsp;
                        <?php
                            include("connect.php");
                            $query = "SELECT * FROM department ";
                            $query = mysqli_query($conn, $query);
                            ?>
                        <label for="ccmonth">Department</label>
                        <select class="form-control" id="ccmonth" name="selectdept">
                            <option value="">Select Department</option>
                          <?php
                            while($row = mysqli_fetch_assoc($query)){
                                $deptid=$row['dept_id'];
                                $deptname=$row['dept_name'];
                                echo '<option value="'.$row['dept_id'].'">'.$row['dept_name'].'</option>';
                            }
                            ?>
                          
                        </select>&nbsp;&nbsp;
                            <label for="ccmonth">Course Name</label>
                            <input class="form-control"  type="text" name="coursename" placeholder="Enter New Course">
                      </div>
			<?php
                                include("connect.php");
                                if(isset($_POST['entercourse'])){
                                    $dept_id=$_POST['selectdept'];
                                    $course=$_POST['coursename'];
                                    
                                    $sql = "INSERT INTO course(course_name,dept_id) VALUES ('$course','$dept_id');";
                                    $query=mysqli_query($conn,$sql);
                                        if(!$query){
                                                echo "<p>Error in Addding Course to the Department </p>";
                                        } 
                                        else{
                                                echo "<p>Success Added</p>";
                                        }
                                }
                            ?>
                      
                    
                  </div>
                  <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" name="entercourse" >
                      <i class="fa fa-dot-circle-o"></i> Submit</button>
                    
                      </form>
                </div>
              
	<div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-align-justify"></i>All Course</div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Sl.no</th>
                          <th>Course Name</th>
                          
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            include("connect.php");
                            
                            
                            $query = "SELECT * FROM course where dept_id=$dept";
                            $result=mysqli_query($conn, $query);
                            $num=1;
                            while($row = mysqli_fetch_assoc($result))
                                {
                            ?>
            
                        <tr>
                            <td hidden><?php echo $row['course_id']; ?></td>
                            <td style="width:20%"><?php echo $num; ?></td>
                            <td style="width:60%"><?php echo $row['course_name']; ?></td>
                            <td style="width:20%"><a class="btn btn-primary" href="admin/updatecourse.php?id=<?php echo $row['course_id']; ?>">Update</a></td>
                        </tr>
                        <?php 
                            $num++; 
                                   }
                                
                                   
                        ?>

                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>
              <!-- /.col-->
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