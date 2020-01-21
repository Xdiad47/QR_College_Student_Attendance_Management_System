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
    <title>Attendance Time</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link href="css/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="bootstrap-datetimepicker.min.css">
<script src="bootstrap-datetimepicker.min.js"></script>
    

</head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
       <a href="#"><h2><font color="blue"> Online</font><font color="gold">Attendance</h2></font></font></a>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
              <li class="nav-item "><a class="nav-link " href="faculty_home.php">HOME</a></li>
            <li class="nav-item btn-primary"><a class="nav-link " href="#">Attendance</a></li>
            <li class="nav-item"><a class="nav-link " href="report.php">Report</a></li>
            
            <li class="nav-item"><a class="nav-link " href="logout.php">Logout</a></li>
          </ul>
        </nav>  
      </div>
      <main class="main">
          
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
              $d=date("Y");
              $query = "SELECT * FROM department where dept_id=$dept";
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
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                      <tbody>
                          <tr>
                              <td style="width:33%">From</td>
                              <td style="width:33%">To</td>
                              <td style="width:33%">Allowed</td>
                              
                          </tr>
                          <tr>
                               <td style="width:33%"><input class="form-control" type="time"  name="fromtest" > </td>
                                <td style="width:33%"><input class="form-control" type="time"  name="totest"  ></td>
                                <td style="width:33%"><input class="form-control" type="time" placeholder="Attendance Allowed" name="hour"  ></td>
                           </tr>
                          <tr>
                              <td style="width:33%" hidden >Id</td>
                              <td style="width:10%">Course</td>
                              <td style="width:10%">Subject</td>
                              <td style="width:10%">batch</td>
                              
                              <td style="width:33%">&nbsp;&nbsp;Session&nbsp;&nbsp;</td>
                              <td style="width:33%">Start</td>
                              
                           </tr>
                           
                          <?php
                            $sql="Select * from faculty_subject where faculty_id=$id  and year_of_assign='$d'";
                            $query=mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($query)) {
                          ?>
                           
                            <tr>
                                <td style="width:33%" hidden ><input class="form-control" type="text" value="<?php echo $row['faculty_id']; ?>" name="id" required ></td>
                                <td style="width:10%"><input class="form-control" type="text" value="<?php echo $row['course_id']; ?>" name="course" ></td>
                                <td style="width:10%"><input class="form-control" type="text" value="<?php echo $row['sub_id']; ?>" name="sub" ></td>
                                <td style="width:10%"><input class="form-control" type="text" value="<?php echo $row['std_batch']; ?>" name="batch" ></td>
                                
                                <td style="width:33%"><input class="form-control" type="text" value="<?php  $ss=$row['session']; if($ss==1){echo "Autumn";}else{echo "Spring";} ?>"  name="s" ></td>
                                
                                
                                <td style="width:33%"><button class="btn btn-sm btn-primary" type="submit" name="start" ><i class="fa fa-dot-circle-o"></i>Start Scanning</button></td>
                             </tr>
                             
                           <?php      
                            }
                            ?>
                             
                        </tbody>
                    </table>
                     </form>
                    <?php
                      if(isset($_POST['start'])){
                         $fid=$_POST['id'];
                        $cid=$_POST['course'];
                        $sid=$_POST['sub'];
                        $batch=$_POST['batch'];
                        $date=date('Y-m-d');
                         $ss;
                        $from=$_POST['fromtest'];
                        $to=$_POST['totest'];
                        $start=new DateTime($from);
                        $since_start=$start->diff(new DateTime( $to));
                        $total=$since_start->h;
                        $all=$_POST['hour'];
                        $sql="INSERT INTO log_book(faculty_id,time_from,time_to,allowed_hr,course_id,sub_id,std_batch,total_class,date,sessions)VALUES($fid,'$from','$to','$all',$cid,$sid,$batch,$total,'$date',$ss)";
                        $query=mysqli_query($conn, $sql);
                        if(!$query){
                            ?>
                         <script type="text/javascript">
                        
                            if(confirm("Sorry Unable To start Taking Attendance")){
                                window.location.href="setscantime.php"; 
                            }  
                         </script>
                          <?php  
                        }
                        else{
                           $start="SELECT * FROM log_book where faculty_id=$fid and time_from='$from' and time_to='$to'and allowed_hr='$all' and course_id=$cid and sub_id=$sid and std_batch=$batch and date='$date'and sessions=$ss";
                            $qu=mysqli_query($conn, $start);
                            if($query){
                                $row= mysqli_fetch_assoc($qu);
                                $record=$row['logbook_id'];
                                $rec_id=$_SESSION['recordid']=$record;
                                $t=$_SESSION['allowed']=$all;
                                echo $t;
                                $class=$_SESSION['class']=$total;
                                ?>
                                <script type="text/javascript">
                        
                                
                                window.location.href="scan.php"; 
                              
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
              <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-align-justify"></i>All Course</div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th>Course.no</th>
                          <th>Course Name</th>
                          
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            include("connect.php");
                            
                            
                            $query = "SELECT * FROM course where dept_id=$dept";
                            $result=mysqli_query($conn, $query);
                            
                            while($row = mysqli_fetch_assoc($result))
                                {
                            ?>
            
                        <tr>
                            <td ><?php echo $row['course_id']; ?></td>
                            
                            <td style="width:60%"><?php echo $row['course_name']; ?></td>
                            
                        </tr>
                        <?php 
                             
                                   }
                                
                                   
                        ?>

                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
              <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <strong>All Subject</strong></div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th style="width: 10%;">Subject Code</th>
                          <th style="width: 50%;">Subject Name</th>
                          
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            
                               
                            $query = "SELECT distinct sub_id,sub_name  FROM subject,course where course.course_id=course.dept_id=$dept";
                            $result=mysqli_query($conn, $query);
                                if(mysqli_num_rows($result) > 0)
                                    {
                                    
                                        while($row = mysqli_fetch_assoc($result))
                                            {
                        ?>
						<tr>
                            <td style="width: 10%;"><?php echo $row['sub_id']; ?></td>
                            
                            <td style="width: 50%;"><?php echo $row['sub_name']; ?></td>
                            
                            
                        </tr>
                        <?php 
                            
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
