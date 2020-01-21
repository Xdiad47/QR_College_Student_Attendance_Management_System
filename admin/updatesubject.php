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
    $id = $_GET['id'];
    
  $query = "SELECT * FROM subject WHERE sub_id=$id";
  $executequery = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($executequery)){
            $name=$row['sub_name'];
          
    }
    if(isset ($_POST['updatesubject'])){
        $s_id = $_GET['id'];
        $s_name=$_POST['s_name'];
        
        $update = "UPDATE subject SET sub_name = '$s_name' where sub_id=$s_id ";
            if (mysqli_query($conn, $update)) {
                ?>
               <script type="text/javascript">
                        
                    if(confirm("Subject Update Successfully")){
                    window.location.href="subject.php"; 
                         }  
                       </script>
            <?php
               
            }
            else{
                echo "cant update";
            }
             
    }
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

<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Update subject</strong>
        </div>
        <div class="card-body">
  <table id="bootstrap-data-table" class="table table-striped table-bordered">
<form method="POST" action="">
    <tbody>
    <input hidden  type="text" name="s_id"  class="form-control" readonly value="<?php echo $id; ?>"/></br>
    <input type="text" name="s_name"  class="form-control" value="<?php echo $name; ?>" /></br></br>

    <div id="update" align="right">
    <input type="submit" class="btn btn-primary" name="updatesubject" value="update" >

    </div>


    </tbody>
    </form>	
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