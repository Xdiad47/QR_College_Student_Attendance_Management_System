<?php
include("connect.php");
session_start();
if(!isset($_SESSION['name'])|| ($_SESSION['name']=='') and ($_SESSION['dept'])|| ($_SESSION['dept']=='') and ($_SESSION['id'])|| ($_SESSION['id']=='') )
{
 
 header("Location:../index.php");
}
else {
    $id= $_SESSION['id'] ;
 $name=$_SESSION['name'];
 $dept=$_SESSION['dept'];
if(isset($_GET['id'])){
    $s=$_GET['id'];
    $i=1;
    $update = "UPDATE faculty_info SET status = '$i' where faculty_id=$s ";
            if (mysqli_query($conn, $update)) {
                
                header("location:faculty.php");
            }
            else{
                echo '<p>Cant Update</p>';
            }
}
if(isset($_GET['sid'])){
    $s=$_GET['sid'];
    $i=0;
    $update = "UPDATE faculty_info SET status = '$i' where faculty_id=$s ";
            if (mysqli_query($conn, $update)) {
                
                header("location:faculty.php");
            }
            else{
                echo '<p>Cant Update</p>';
            }
}
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
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script type="text/javascript">
           function Update(id){
             if(confirm("Activate  Access")){
                 window.location.href="admin/faculty.php?id="+id; 
             }  
           }
           function Updates(sid){
             if(confirm("De-Active Faculty Account")){
                 window.location.href="admin/faculty.php?sid="+sid; 
             }  
           }
     </script>
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
              <li class="nav-item "><a class="nav-link " href="admin/course.php"> Program</a></li>
              <li class="nav-item btn-primary"><a class="nav-link " href="admin/faculty.php">Manage Faculty</a></li>
              <li class="nav-item "><a class="nav-link " href="admin/faculty_subject.php"> Initialization</a></li>
              <li class="nav-item "><a class="nav-link " href="admin/report.php"> Report</a></li>
              
              <li class="nav-item "><a class="nav-link " href="logout.php"> Logout</a></li>
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
                  <div class="card-header">
                    <i class="fa fa-align-justify"></i>All Course</div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                            <th style="width: 5%;">Sl.no</th>
                          <th style="width: 50%;">Faculty Name</th>
                          <th style="width: 5%;">Status</th>
                          <th style="width: 10%;" colspan="2">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            include("connect.php");
                            
                            
                            $query = "SELECT * FROM faculty_info where dept=$dept";
                            $result=mysqli_query($conn, $query);
                            $num=1;
                            while($row = mysqli_fetch_assoc($result))
                                {
                            ?>
            
                        <tr>
                            <td hidden><?php echo $row['faculty_id']; ?></td>
                            <td style="width:10%"><?php echo $num; ?></td>
                            <td style="width:50%"><?php echo $row['faculty_name']; ?></td>
                            <td style="width:10%"><b><?php $s=$row['status']; if($s==0){ echo "Deactive"; }else{ echo "Active";} ?></b></td>
                            <?php
                            $sta=$row['status'];
                            if($sta==0){
                            ?>
                            <td style="width:15%" ><button class="btn btn-primary" onclick="Update(id=<?php echo $row['faculty_id']; ?>)">Activate</td>
                            <?php
                            }
                            else{
                            ?>    
                            <td ><button class="btn btn-primary" onclick="Updates(sid=<?php echo $row['faculty_id']; ?>)">DeActivate</td>
                         </tr>
                        <?php 
                            }
                            $num++; 
                                   }
                                
                                   
                        ?>

                      </tbody>
                    </table>
                    
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
