<?php
include("connect.php");
session_start();
if(!isset($_SESSION['name'])|| ($_SESSION['name']=='') and ($_SESSION['dept'])|| ($_SESSION['dept']=='') and ($_SESSION['id'])|| ($_SESSION['id']=='') and ($_SESSION['recordid'])|| ($_SESSION['recordid']=='')and ($_SESSION['allowed'])|| ($_SESSION['allowed']=='')and ($_SESSION['class'])|| ($_SESSION['class']=='') )
{
 
 header("Location:index.php");
}
else {
    $id= $_SESSION['id'] ;
 $name=$_SESSION['name'];
 $dept=$_SESSION['dept'];
 $recordid=$_SESSION['recordid'];
 $allow=$_SESSION['allowed'];
 
 $class=$_SESSION['class'];
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <title>Checking Requirement</title>
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
      
      <main class="main" >
          
        <?php
        include("connect.php");
        if(!isset($_GET['id'])){
            
            ?>
            
      <div class="row justify-content-center" >
        <div class="col-md-6">
          <div class="clearfix">
            
            <h4 class="pt-3">Un-Authorized Access</h4>
            <p class="text-muted">Access to this page is forbidden</p>
            <a class="btn btn-warning btn-big"  href="scan.php">Scan Your Code First</a>
          </div>
          
        </div>
      </div>
   
          <?php
        }
        else    
            {
            
             $data=$_GET['id'];
             
             
             $id= base64_decode($data);
             
             $sql = "SELECT * FROM student_info WHERE std_id =$id ";
             $res = mysqli_query($conn, $sql);
             $row=mysqli_num_rows($res);
             if(!$row == 1){
             ?>
                <div class="row justify-content-center" >
                    <div class="col-md-6">
                         <div class="clearfix">
                             
                             <h4 class="pt-3">Oops, Something went wrong</h4>
                             <p class="text-muted">The code did not match !</p>
                             <a class="btn btn-warning btn-big"  href="scan.php">Get Back to Scan Again</a>
                        </div>
          
                    </div>
                </div>
                <?php
              }
              else{
                        $row = mysqli_fetch_assoc($res);
                        $stdid=$row['std_id'];
                        $recordid;
                        $date=date('Y-m-d');
                        $atten="select * from attendance_info where std_id=$stdid and logbook_id=$recordid and atten_taken=$date";
                        $result= mysqli_query($conn, $atten);
                        $check=mysqli_num_rows($result);
                        if($check==1){ 
                        ?>
                        <div class="row justify-content-center" >
                        <div class="col-md-6">
                         <div class="clearfix">
                             
                             <h4 class="pt-3">Your Attendance Is Already Taken</h4>
                             <p class="text-muted">Give Chance To other</p>
                             <a class="btn btn-warning btn-big"  href="scan.php">Back</a>
                        </div>
                       </div>
                     </div>
                      <?php
                      }
                     else{
                         $allow=$_SESSION['allowed'];
                         $class=$_SESSION['class'];
                         $time=date_default_timezone_set('Asia/Kolkata');
                         $times=date("h:i",time());
                         if(strtotime($times)>strtotime($allow)){
                             $sub=1;
                             $attended=$class-$sub;
                         }
                         else{
                             $attended=$class;
                         }
                         $stdid=$row['std_id'];
                         $date=date('Y-m-d');
                        echo $date;
                        echo $attended;
                         $recordid;
                        echo $stdid;
                       $giveattendance="INSERT INTO attendance_info(std_id,logbook_id,attended,atten_taken)VALUES($stdid,$recordid,$attended,'$date');";
                       $given= mysqli_query($conn, $giveattendance);
                       if(!$given){
                           
                           ?>
                      <div class="row justify-content-center" >
                        <div class="col-md-6">
                         <div class="clearfix">
                             
                             <h4 class="pt-3">Sorry unable to process your request</h4>
                             
                             <a class="btn btn-warning btn-big"  href="scan.php">Back</a>
                        </div>
                       </div>
                       </div>
                     <?php
                        }
                       else{
                          ?> 
                            <script type="text/javascript">
                        
                            if(confirm("Attendance Taken Successfully")){
                            window.location.href="scan.php"; 
                         }  
                       </script>
                       <?php
                       }
                     }
                   ?>
            
          <?php
              }
             }
             
            
         ?>  
         
      </main>
      
    </div>
    
</html>
<?php
}
?>

