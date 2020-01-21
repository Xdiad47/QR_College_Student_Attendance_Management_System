<!DOCTYPE html>


<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    
    <title>Scanner</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link href="css/style.css" rel="stylesheet">
    
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
  <script type="text/javascript" src="js/zxing.js"></script>
  <script type="text/javascript" src="js/camera.js"></script>
  <script type="text/javascript" src="js/qr.js"></script>
  <script type="text/javascript" src="js/material.min.js"></script>
  <script type="text/javascript" src="js/clipboard.min.js"></script>
  <script type="text/javascript" src="js/store.min.js"></script>
  <script type="text/javascript" src="js/visibility.min.js"></script>
  <script type="text/javascript" src="js/FileSaver.min.js"></script>
  <script type="text/javascript" src="js/vue.min.js"></script>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
       <a href="#"><h2><font color="blue"> Online</font><font color="gold">Attendance</h2></font></font></a>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
             
            <li class="nav-item  btn-primary"><a class="nav-link " href="#">Scanning</a></li>
            

          </ul>
        </nav>  
      </div>
      <main class="main">
          <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="scanhistory.php">History</a>
          </li>
          <li class="breadcrumb-item">
              <a href="setscantime.php">Set New Time</a>
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
              
                 <form>
            <table align="center" class="table table-bordered data-table table-striped">
              <tr>
			  <th>
			     <div class="checkbox switch">
                  <label for="play-audio">
                     Alert<input class="access-hide" id="play-audio" name="play-audio" type="checkbox" v-model="playAudio">
                   
                  </label>
                </div>
			  </th>
			  <th>
			     <div class="checkbox switch">
                  <label for="http-action">
                    Auto Process<input class="access-hide" id="http-action" name="http-action" type="checkbox" v-model="httpAction.enabled">
                    
                  </label>
                  
                </div>
			  </th>
			  <th>
			     <div class="radiobtn radiobtn-adv">
                  <label for="link-new-tab">
                    New Tab<input class="access-hide" id="link-new-tab" name="link" type="radio" value="new-tab" v-model="linkAction">
                    
                    
                  </label>
                </div>
			  </th>
			  <th>
			     <div class="radiobtn radiobtn-adv">
                  <label for="link-current-tab">
                   Current Tab <input class="access-hide" id="link-current-tab" name="link" type="radio" value="current-tab" v-model="linkAction">
                   
                    
                  </label>
                </div>
			  </th>
			  </tr>
              <tr>
			  <td colspan="4"><center><div id="camera"/></div></center></td>
			  </tr>
			  <tr>
			  <td colspan="4"><center><h5>Place Yor Code Inside The Box</h5></center></td>
			  </tr>
              </table>
          </form>
      <script type="text/javascript" src="js/app.js"></script> 
              
          </div>
        </div>
        
        
      </main>
      
    </div>
    
    </body>
</html>


