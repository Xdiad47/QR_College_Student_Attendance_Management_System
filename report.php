<?php
include 'connect.php';
session_start();
if(!isset($_SESSION['name'])|| ($_SESSION['name']=='') and ($_SESSION['dept'])|| ($_SESSION['dept']=='') and ($_SESSION['id'])|| ($_SESSION['id']=='') )
{
 
 header("Location:index.php");
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
    
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Attendance Report</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link href="css/style.css" rel="stylesheet">
    
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
 
  
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
       <a href="#"><h2><font color="blue"> Online</font><font color="gold">Attendance</h2></font></font></a>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
             
            <li class="nav-item "><a class="nav-link " href="#">Attendance</a></li>
            <li class="nav-item btn-primary"><a class="nav-link " href="report.php">Report</a></li>
            <li class="nav-item"><a class="nav-link " href="profile.php">Profile</a></li>
            <li class="nav-item"><a class="nav-link " href="logout.php">Logout</a></li>
                        

          </ul>
        </nav>  
      </div>
      <main class="main">
          <ol class="breadcrumb">
          
          <li class="breadcrumb-item active">
              <a href="setscantime.php">Scan Time</a>
          </li>
          <li class="breadcrumb-item">
              <a href="report.php">Report</a>
          </li>
          <li class="breadcrumb-item">
              <a href="profile.php">Profile</a>
          </li>
          <li class="breadcrumb-item">
              <a href="logout.php">Logout</a>
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
                    
                  <div class="card-body">
                    <form method="POST" action="">
                        <tr>
                            <td colspan="4"><input type="text" name="id" placeholder="Student_id"></td>
                            <td colspan="3"><input type="submit" name="report" value="submit"></td>
                            
                        </tr>
                    </form>
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        
                        <?php 
                        if(isset($_POST['report'])){
                            $stdid=$_POST['id'];
                            $s=$_SESSION['sid']=$stdid;
                            echo $s;
                        ?>
                      <tbody>
                          <tr>  
                              <td colspan="7"><center><b>REPORT</b></center></td>
                         
                         </tr>
                          <tr>  
                         <td colspan="4"><b>FACULTY:<?php echo $name; ?></b></td>
                         <td colspan="3" align="right"><b>DEPARTMENT:<?php 
                            $query = "SELECT * FROM department where dept_id=$dept ";
                                    $query = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($query);
                                    $deptname=$row['dept_name'];
                                    echo $deptname;
                          ?></b>
                         </td>
                         </tr>
                         <tr>
                          
                          
                         <th>Student ID</th>
                         <th>Course</th>
                         <th>Subject</th>
                         <th>Batch</th>
                         <th>Total class</th>  
                         <th>Total Attended</th>
                         <th>Percentage</th>  
                         
                         
                    </tr>
                    <?php
	            $sql = "SELECT attendance_info.std_id,log_book.std_batch,attendance_info.attended,log_book.total_class,log_book.sub_id,log_book.course_id FROM attendance_info,log_book where log_book.logbook_id=attendance_info.logbook_id  and attendance_info.std_id=$stdid and log_book.faculty_id=$id;";  
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result))  
                    {  
                     ?>  
                        <tr> 
                            
                           <td><?php echo $row["std_id"]; ?></td>
                           <td><?php echo $row["course_id"]; ?></td>
                           <td><?php echo $row["sub_id"]; ?></td>
                           <td><?php echo $row["std_batch"]; ?></td>
                           <td><?php echo $row["total_class"]; ?></td>  
                           <td><?php echo $row["attended"]; ?></td>
                           <td><?php echo $percent=($row["attended"]/$row["total_class"])*100; ?></td>  
                           
                        </tr>
                        <?php
                    }
                    }
                ?>
                    
                      </tbody>
                    </table>
                    <form method="POST" action="export.php">
                        <input type="submit" name="export" class="btn btn-success" value="Export in Excel" />
                        
                    </form>
                      <form method="POST" action="expword.php">
                        <input type="submit" name="export" class="btn btn-success" value="Export In word" />
                        
                    </form>
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
