
<?php
include("connect.php");
session_start();
if(!isset($_SESSION['regid'])|| ($_SESSION['regid']=='') )
{
    header("Location:index.php");
}

else
{
    $data=$_SESSION["regid"];
if(count($_POST)){
  include "qr.php";
  $qr = new BarcodeQR();

  if(isset($_POST['url'])){
    $qr->bookmark($_POST['url']);
  
  }elseif(isset($_POST['only_url'])){
    $qr->url($_POST['only_url']);
  }
}
$size = array('5'=>'232','6'=>'290');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./../">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>QR code</title>
    
    
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link href="css/style.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap.min.js"></script>
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
             
            <li class="nav-item  btn-primary"><a class="nav-link " href="#">QR Code</a></li>
            

          </ul>
        </nav>  
      </div>
      <main class="main">
          <ol class="breadcrumb">
              <li class="breadcrumb-item">
		  <a href="logout.php">Logout</a>
              </li>
          </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
              <div class="row">
                  <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>QR Code Will Generate here</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="" method="POST" class="form-horizontal">
                <div class="control-group">
              <div class="controls" hidden>
                  
                  <input type="text" hidden name="url" value='<?php   $id=base64_encode($data); $ul="http://localhost/onlineattendance/processing.php?id=$id";echo $ul;  ?>' >
              </div>
            </div>
            
              
              
                <button type="submit" class="btn btn-info"><i class="icon-qrcode"></i>Generate</button>
                <?php if(count($_POST)){
                 ?>
                <table align="center">
                <tr>
                    <td> <div class="well" >
                            
                            <?php
                            $img = "qrcode".time().".png";
                            if(!isset($_POST['img_size'])) $_POST['img_size'] = 174;
                            $qr->generate($_POST['img_size'], "qrimage/img/".$img);?>
                            <div class="center" span="10">
                                <a href="qrimage/img/<?php echo $img?>" download class="btn btn-primary">
                                 <img src="qrimage/img/<?php echo $img?>" width="<?php echo $_POST['img_size']?>" height="<?php echo $_POST['img_size']?>" >
                                 &nbsp;&nbsp;<p>Download</p>
                             </a>
                                
                            </div>
                        </div></td>
            
                </tr>
                            <?php } 
                            ?>
                </table>
            </form>
              
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