<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./../">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <title>Student Registration</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link href="style.css" rel="stylesheet">
    
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
    </header>&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="container-fluid" id='reg'>
          <div class="animated fadeIn">
            
           <div class="card">
                  <div class="card-header">
                    <strong>Select Department</strong></div>
                  <div class="card-body">
                    <form class="form-inline" action="" method="POST">
                      <div class="form-group">
                         <?php
                            include("connect.php");
                            $query = "SELECT * FROM department ";
                            $query = mysqli_query($conn, $query);
                            ?>
                        
                        Department: &nbsp;&nbsp;&nbsp;<select class="form-control" id="ccmonth" name="dept">
                                <option value="">Select Department</option>
                          <?php
                                    while($row = mysqli_fetch_assoc($query)){
                                        $deptid=$row['dept_id'];
                                        $deptname=$row['dept_name'];
                                        
                                        echo '<option value="'.$row['dept_id'].'">'.$row['dept_name'].'</option>';
                                    }
                                    ?>
                          
                        </select>
                      </div>
                    
                  </div>
                  <div class="card-footer">
                      <input type="submit" name="ok" value="Proceed" class="btn btn-sm btn-primary">
                    
                  </div>
               </form>
                </div>
              <?php
                    if(isset($_POST['ok'])){
                        $dept=$_POST['dept'];
                        session_start();
                        $_SESSION['stu_dept']=$dept;
                        header("Location:student_registration.php");
                        
                    }
               ?>
           </div>
      </div>
   </body>
</html>


