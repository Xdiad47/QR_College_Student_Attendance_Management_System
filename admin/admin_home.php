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
    
    <title>Admin </title>
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
              <li class="nav-item  btn-primary"><a class="nav-link " href="admin_home.php">HOME</a></li>
              <li class="nav-item "><a class="nav-link " href="subject.php"> Subject</a></li>
              <li class="nav-item "><a class="nav-link " href="course.php"> Program</a></li>
              <li class="nav-item "><a class="nav-link " href="faculty.php">Manage Faculty</a></li>
              <li class="nav-item "><a class="nav-link " href="faculty_subject.php"> Initialization</a></li>
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



