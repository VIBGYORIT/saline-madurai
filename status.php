<?php
  ob_start();
  header("Cache-Control: no-cache, must-revalidate");
  session_start();
  include 'includes/conn.php';
  if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit();
  }
  else
  {
    $sql = mysqli_query($conn,"SELECT * from users WHERE deviceid = '".$_SESSION['id']."'");
    $row = mysqli_fetch_assoc($sql);
    if(!isset($row['authsuccess']))
    {
      header("Location: authuser.php?deviceid='".$_SESSION['id']."'");
      exit();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Saline Admin Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="./dist/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="./dist/js/jquery.dataTables.min.js" defer></script>
    <script type="text/javascript" src="./dist/js/dataTables.bootstrap.min.js" defer></script>	
    <script type="text/javascript" src="./dist/js/ajax.js"></script>		

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="./assets/images/favicon.png" />
    <style>
      .card 
      {
        color: black !important;
      }
      .new
      {
        margin-top: 10px !important;
      }
      .cardnew
      {
        margin-bottom: 10px !important;
      }
      select 
      {
        width: 100%;
        height: 40px;
        border-radius: 10px;
        text-indent: 5px;
      }
      .progress
      {
        height: 30px;
        border-radius: 15px;
      }
      .progress-bar
      {
        padding: 15px;
        font-weight: bold;
        font-size: 24px;
      }
      .ref-con
      {
        display: block;
      }
      .refresh 
      {
        width: 160px;
        float: right;
        border-radius: 12px;
        padding: 10px 0px;
      }
      .container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.container .buttons {
  display: flex;
  flex-direction: column;
}
.container input {
  padding: 10px 0px;
  width: 100px;
  font: 16px "Montserrat", sans-serif;
  font-weight: bold;
  text-transform: uppercase;
  text-decoration: none;
  text-align: center;
  margin: 1em;
}

.button1 {
  color: white;
  cursor: pointer;
  background-color: #2d7eff;
  border: 2px solid transparent;
  transition: 0.2s ease;
  border-radius: 10px;
}

.button1:hover {
  color: #2d7eff;
  background-color: white;
  transform: scale(1.1);
  border: 2px solid #2d7eff;
}
input[type='time']
{
  border-radius: 10px;
  padding: 8px 20px;
  border: none;
}
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <!-- <a class="sidebar-brand brand-logo" href="home.php"><img src="./assets/images/logo.svg" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="home.php"><img src="./assets/images/logo-mini.svg" alt="logo" /></a> -->
          <a class="sidebar-brand brand-logo Chead" href="home.php"><h2>S A L I N E</h2></a>
          <a class="sidebar-brand brand-logo-mini Chead" href="home.php"><h2>S</h2></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="./assets/images/faces/face15.jpg" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal"><?php echo $_SESSION['username']; ?></h5>
                  <span>Gold Member</span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar-today text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="./home.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Patient Details</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="status.php">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Patient Status</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" target="_blank" href="https://www.vbindinnovation.com/">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <!-- <a class="navbar-brand brand-logo-mini" href="home.php"><img src="./assets/images/logo-mini.svg" alt="logo" /></a> -->
            <a class="navbar-brand brand-logo-mini Chead" href="home.php"><h2>S</h2></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search products">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-view-grid"></i>
                </a>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <span class="count bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="./assets/images/faces/face4.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                      <p class="text-muted mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="./assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                      <p class="text-muted mb-0"> 15 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="./assets/images/faces/face3.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                      <p class="text-muted mb-0"> 18 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">4 new messages</p>
                </div>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-calendar text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Event today</p>
                      <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                      <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-link-variant text-warning"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Launch Admin</p>
                      <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="./assets/images/faces/face15.jpg" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $_SESSION['username']; ?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" onclick="window.location.href='logout.php';">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Log out</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">Advanced settings</p>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header" style="justify-content: center !important;">
              <center><h2 class="page-title" style="font-size: 2rem;"> Patient Status </h2></center>
            </div>
<div class="col-md-12 ">
<div class="row">
<?php
  		if(isset($_SESSION['success'])){
  			echo "<div class='success container-2 text-align-center justify-content-center col-xl-8 col-md-8 col-sm-10 col-xs-10'>";?>
        <span class="closebtn" style="padding-left: 10px;font-size:28px;font-weight:bold;float:right;" onclick="this.parentElement.style.display='none';">&times;</span> 
        <?php 
        echo "<strong style='display:table;margin:0 auto; margin-top:10px;text-align:center;'>".$_SESSION['success']."</strong>
        </div>
  			";
  			unset($_SESSION['success']);
  		}
      if(isset($_SESSION['error'])){
  			echo "<div class='alert container text-align-center justify-content-center col-xl-8 col-md-8 col-sm-10 col-xs-10'>";?>
        <span class="closebtn" style="padding-left: 10px;font-size:28px;font-weight:bold;float:right;" onclick="this.parentElement.style.display='none';">&times;</span> 
        <?php 
        echo "<strong style='display:table;margin:0 auto; text-align:center;'>".$_SESSION['error']."</strong>
        </div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
				<!-- <div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" align="right">
					<button type="button" name="add" id="updateRecord" class="btn btn-success update"> + Update</button>
				</div> -->
			</div>
      <br>
      <?php
    include './includes/conn.php';
    $sql = mysqli_query($conn,"SELECT * from users WHERE deviceid = '".$_SESSION['id']."'");
    $row = mysqli_fetch_assoc($sql);
     ?>
    <div class="row ">
    <div class="col-md-12">
        <h5 class="black">status</h5> 
        <div class="card black"> 
            <div class="card-statistic-3 p-4">
                <div class="card-icon "></div>
                <!-- <div class="mb-4">
                    <h5 class=" black mb-0">bottle empty....</h5>
                </div>
                <div class="row align-items-center mb-2 d-flex">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            please refill
                        </h2>
                    </div>
                </div> -->
                <div class="progress">
                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;">
                      80%
                  </div>
                </div>
            </div>
      </div>
    </div>
    <div class="col-md-12 ">
        <div class="row ">
        <h5 class="black">Monitoring</h5> 

            <div class="col-xl-4 col-lg-6">

                <div class="card cardnew">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon "></div>
                        <div>
                            <h4 class=" black mb-0"><?php echo $row['dpm']; ?> dpm</h4>
                        </div>
                        <!-- <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    15278
                                </h2>
                            </div>
                        </div> -->
                    </div>
                </div>
                <center><h5 class="black">Drips Per Minute</h5></center>

            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card cardnew">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon "></div>
                        <div>
                            <h4 class="black mb-0"><?php echo $row['remain']; ?> ml</h4>
                        </div>
                        <!-- <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    Sinehan S
                                </h2>
                            </div>
                        </div> -->
                    </div>
                </div>
                <center><h5 class="black">Remaining volume</h5></center>

            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card cardnew">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon "></div>
                        <div>
                            <h4 class="black mb-0"><?php echo $row['consume'];?> ml</h4>
                        </div>
                        <!-- <div class="row align-items-center mb-2 d-flex">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    130
                                </h2>
                            </div>
                        </div> -->
                    </div>
                </div>
                <center><h4 class="black">consumed volume</h4></center> 

            </div>
            </div>
        </div>
    </div>
    <br>
    <div class="col-md-12 ">
        <div class="row ">
        <center><h2 class="black" style="--bs-gutter-x: 0rem;">Controlling</h2> </center>
        <div class="ref-con">
          <button class="refresh" onclick="window.location.reload();"><i class="fa fa-refresh" style="font-size: 20px;"></i> Refresh Page</button>
        </div>
        <form action="updateTime.php" method="POST" class="row">
        <div class="col-xl-4 col-lg-6 new">
                  <div class="box cardnew">
                    <select name="total">
                      <option>250</option>
                      <option>500</option>
                      <option>750</option>
                      <option>1000</option>
                      <option>custom</option>
                    </select>
                  </div>
                  <center><h5>Total (Capacity in ML)</h5></center>
        </div>
        <div class="col-xl-4 col-lg-6 new">
                  <div class="box cardnew">
                    <select name="consume">
                      <option>20</option>
                      <option>40</option>
                      <option>60</option>
                      <option>80</option>
                      <option>custom</option>
                    </select>
                  </div>
                  <center><h5>Consume (Capacity in ML)</h5></center>
        </div>
        <div class="col-xl-4 col-lg-6 new">
                  <div class="box cardnew" style="display: flex; justify-content: center;">
                  <input type='time' value='now' name="start" id="start"/>
                  </div>
                  <h5 style="text-align: center;">Start time</h5>
        </div>
        <div class="col-xl-4 col-lg-6 new">
                  <div class="box cardnew" style="display: flex; justify-content: center;">
                  <input type='time' value='then' name="end" id="end"/>
                  </div>
                  <h5 style="text-align: center;">End time</h5>
        </div>
        <center>
          <div class="container">
	          <div class="buttons">
		          <input class="button1 btn" type="submit" value="SET" id="set">
	          </div>
          </div>
        </center>
        </form>
        </div>
    </div>
</div>
            <div class="row">
            <div class="container contact col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12">	
	<div id="recordModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" action="editrecord.php">
    			<div class="modal-content">
    				<div class="modal-header">
              <h4 class="modal-title"><i class="fa fa-plus"></i> Edit Record</h4>
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
    				</div>
    				<div class="modal-body">
						<div class="form-group">
							<label for="username" class="control-label">Patient Name</label>
							<input type="text" class="form-control" id="username" value="<?php echo $row['username']; ?>" name="username" placeholder="Patient Name" required>			
						</div>
            <div class="form-group">
							<label for="firstname" class="control-label">Full Name</label>							
							<input type="text" class="form-control" id="firstname" value="<?php echo $row['firstname']; ?>" name="firstname" placeholder="First Name">			
						</div>
						<div class="form-group">
							<label for="location" class="control-label">Location</label>							
							<input type="text" class="form-control" id="location" value="<?php echo $row['location']; ?>" name="location" placeholder="Location">							
						</div>	   	
						<div class="form-group">
							<label for="phone" class="control-label">Phone Number</label>							
							<input type="number" class="form-control"  id="phone" value="<?php echo $row['phone']; ?>" name="phone" placeholder="Phone Number" required>							
						</div>	 
						<div class="form-group">
							<label for="dpm" class="control-label">dpm</label>							
							<input class="form-control" type="number" id="dpm" value="<?php echo $row['dpm']; ?>" name="dpm" placeholder="dpm"></textarea>							
						</div>						
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="deviceid" id="deviceid" value="<?php echo $row['deviceid']; ?>" />
              <input type="hidden" name="action" id="action" value="" />
    					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Copyright © <a href="https://www.vbindinnovation.com/" target="_blank">VBIND Innovations</a> 2022</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="./assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="./assets/js/off-canvas.js"></script>
    <script src="./assets/js/hoverable-collapse.js"></script>
    <script src="./assets/js/misc.js"></script>
    <script src="./assets/js/settings.js"></script>
    <script src="./assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
    <script>
      $(function(){     
  var d = new Date(),        
      h = d.getHours(),
      h1 = d.getHours()+1,
      m = d.getMinutes();
  if(h < 10) h = '0' + h; 
  if(h1 < 10) h1 = '0' + h1; 
  if(m < 10) m = '0' + m; 
  $('input[type="time"][value="now"]').each(function(){ 
    $(this).attr({'value': h + ':' + m});
  });
  $('input[type="time"][value="then"]').each(function(){ 
    $(this).attr({'value': h1 + ':' + m});
  });
});
    </script>
      <?php 
date_default_timezone_set("Asia/Kolkata");
$did = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * from users WHERE deviceid = '$did'");
$get = mysqli_fetch_assoc($query);
$start = $get['start'];
$end = $get['end'];
$current = date("Y-m-d H:i",);
// echo "<script>alert('".$start."<br>".$end."<br>".$current."')</script>";
if($start <= $current)
{
  if($current <= $end)
  {
    echo "<script>";
    echo "document.getElementById('set').disabled=true;";
    echo "</script>";
  }
}
$conn->close();
?>
  </body>
</html>