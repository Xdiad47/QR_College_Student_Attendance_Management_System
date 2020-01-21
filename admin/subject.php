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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./../">
    <meta charset="utf-8">
    <title>Admin </title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
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
              <li class="nav-item btn-primary "><a class="nav-link " href="admin/subject.php"> Subject</a></li>
              <li class="nav-item "><a class="nav-link " href="admin/course.php"> Program</a></li>
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
          <strong>Enter New Subject</strong></div>
        <div class="card-body">
          <form class="form-inline" action="" method="POST">
            <div class="form-group">
              <label for="exampleInputName2">Subject</label>&nbsp;&nbsp;
              <input class="form-control" name="sub" type="text" placeholder="Enter New Subject here">&nbsp;&nbsp;
                  <?php
                   $query = "SELECT * FROM course where dept_id=$dept; ";
                   $query = mysqli_query($conn, $query);
                  ?>
          <label for="ccmonth">Course</label>
              <select class="form-control" id="ccmonth" name="selectcourse">
                <?php
                  while($row = mysqli_fetch_assoc($query)){
                      $courseid=$row['course_id'];
                      $coursename=$row['course_name'];
                      //echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';
                      echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';
                  }
                ?>

              </select>
            </div>
                  <?php
                      if(isset($_POST['entersubject'])){
                          $subname=$_POST['sub'];
                          $course_name=$_POST['selectcourse'];
                          
                          $sql = "INSERT INTO subject(sub_name,course_id) VALUES ('$subname','$course_name');";
                          $query=mysqli_query($conn,$sql);
                              if(!$query){
                                      echo "Error in inserting";
                              } 
                              else{
                                  session_start();
                                   $sid=$_SESSION['id'] = $courseid; 
                                  header("location:subject.php");
                              }
                          }
                      ?>
                </div>
                  <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" name="entersubject" >
                      <i class="fa fa-dot-circle-o"></i> Submit</button>
                    
                  </div>
                </div>
              </form>
	    <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <strong>All Subject</strong></div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                            <th style="width: 10%;">Sl.no</th>
                          <th style="width: 50%;">Subject Name</th>
                          
                          <th style="width: 10%;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            
                               
                            $query = "SELECT distinct sub_id,sub_name  FROM subject,course where course.course_id=course.dept_id=$dept";
                            $result=mysqli_query($conn, $query);
                                if(mysqli_num_rows($result) > 0)
                                    {
                                    $num=1;
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                        ?>
						<tr>
                            <td hidden><?php echo $row['sub_id']; ?></td>
                            <td style="width: 10%;"><?php echo $num; ?></td>
                            <td style="width: 50%;"><?php echo $row['sub_name']; ?></td>
                            
                            <td style="width: 10%;"><a class="btn btn-primary" href="admin/updatesubject.php?id=<?php echo $row['sub_id']; ?>">Update</a></td>
                        </tr>
                        <?php 
                            $num++; 
                                   }
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