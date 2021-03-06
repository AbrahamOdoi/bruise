<?php
session_start();
include 'connection.php';
$usersession = $_SESSION['username'];

if (isset($_POST['edit'])) {

	$id = $_POST['row_id'];
	$msisdn = $_POST['number'];
	$sender = $_POST['sender'];
	$message = $_POST['message'];
	$sched_datetime = $_POST['time'];

	$q = "UPDATE schdMsg SET msisdn='$msisdn', subject='$sender', schdtime='$sched_datetime',message='$message' WHERE id='$id'";

	if (mysqli_query($link, $q)) {
		echo "<script>
	alert('Job successfully updated');
	</script>";
	} else {
		echo "<script>
	alert('Job update failed');
	</script>";
	}

}

$query = "SELECT * FROM schdMsg WHERE account='$usersession' and status='pending'";
$result = mysqli_query($link, $query);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>S</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
		<!-- Morris chart -->
		<link rel="stylesheet" href="plugins/morris/morris.css">
		<!-- jvectormap -->
		<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
		<!-- Date Picker -->
		<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
		<!-- Daterange picker -->
		<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
		<!-- bootstrap wysihtml5 - text editor -->
		<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

		<link href="js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">

		<style type="text/css">
			/* css for timepicker */
			.ui-timepicker-div .ui-widget-header {
				margin-bottom: 8px;
			}
			.ui-timepicker-div dl {
				text-align: left;
			}
			.ui-timepicker-div dl dt {
				float: left;
				clear: left;
				padding: 0 0 0 5px;
			}
			.ui-timepicker-div dl dd {
				margin: 0 10px 10px 45%;
			}
			.ui-timepicker-div td {
				font-size: 90%;
			}
			.ui-tpicker-grid-label {
				background: none;
				border: none;
				margin: 0;
				padding: 0;
			}

			.ui-timepicker-rtl {
				direction: rtl;
			}
			.ui-timepicker-rtl dl {
				text-align: right;
				padding: 0 5px 0 0;
			}
			.ui-timepicker-rtl dl dt {
				float: right;
				clear: right;
			}
			.ui-timepicker-rtl dl dd {
				margin: 0 45% 10px 10px;
			}
		</style>

	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<!-- Logo -->
				<a href="" class="logo"> <!-- mini logo for sidebar mini 50x50 pixels --> 
					<span class="logo-mini"><b>A</b>LT</span> <!-- logo for regular state and mobile devices --> 
					<span class="logo-lg"><b>Sav</b>Sign</span>
				</a>
				
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
					<div class="navbar-custom-menu">
						<!-- <ul class="nav navbar-nav"> -->
							<!-- User Account: style can be found in dropdown.less -->
							<!-- <li class="dropdown user user-menu"> -->
								<!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> <span class="hidden-xs">Alexander Pierce</span> </a> -->
								<!-- <ul class="dropdown-menu"> -->
								<!-- User image -->
								<!-- <li class="user-header">
								<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
								<p>
								Alexander Pierce - Web Developer
								<small>Member since Nov. 2012</small>
								</p>
								</li> -->
								<!-- Menu Body -->
								<!-- </ul> -->
								<div><i style="color: white;font-weight: bolder">Logged in as:</i> <i style="color: silver;font-weight: bolder"><?php echo $_SESSION['username'];?></i>&nbsp;&nbsp;&nbsp;
								<a href="signout.php" class="btn btn-default" style="color: black;">Signout</a></div>
					</div>
				</nav>
			</header>
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
						<li class="header">
							MAIN NAVIGATION
						</li>
						<li class="active treeview">
							<a href="#"> <i class="fa fa-dashboard"></i> <span>Messaging</span> <i class="fa fa-angle-left pull-right"></i> </a>
							<ul class="treeview-menu">
								<li>
									<a href="single.php"><i class="fa fa-circle-o"></i> Single Test</a>
								</li>
								<li>
									<a href="bulk.php"><i class="fa fa-circle-o"></i>Bulk messaging</a>
								</li>
								<li>
									<a href="schedule.php"><i class="fa fa-circle-o"></i>Schedule message</a>
								</li>
							</ul>
						</li>
						<li class="active treeview">
							<a href="#"> <i class="fa fa-files-o"></i> <span>Reports</span></a>
							<ul class="treeview-menu">
								<li>
									<a href="24hrReport.php"><i class="fa fa-circle-o"></i>24Hr Report</a>
								</li>
								<li>
									<a href="specificReport.php"><i class="fa fa-circle-o"></i>Specific Report</a>
								</li>
							</ul>
						</li>
						<li class="active treeview">
							<a href="jobs.php"> <i class="fa fa-th"></i> <span>My Jobs</span></a>
							<!-- <ul class="treeview-menu">
								<li>
									<a href="pendingJobs.php"><i class="fa fa-circle-o"></i>Pending Jobs</a>
								</li>
								<li>
									<a href="queuedJobs.php"><i class="fa fa-circle-o"></i>Queued Jobs</a>
								</li>
							</ul> -->
						</li>
						<li>
							<a href="myProfile.php"> <i class="fa fa-user"></i> <span>My Profile</span></small> </a>
						</li>
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1> Scheduled Jobs <small></small></h1>
					<ol class="breadcrumb">
						<li>
							<a href="#"><i class="fa fa-dashboard"></i> Home</a>
						</li>
						<li class="active">
							Dashboard
						</li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<!-- Small boxes (Stat box) -->

					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<!-- <div class="box-header"> -->
								<!-- <h3 class="box-title">Responsive Hover Table</h3> -->
								<!-- <div class="box-tools"> -->
								<!-- <div class="input-group" style="width: 150px;">
								<input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
								<div class="input-group-btn">
								<button class="btn btn-sm btn-default">
								<i class="fa fa-search"></i>
								</button>
								</div>
								</div> -->
								<!-- </div>
								</div --><!-- /.box-header -->
								<div class="box-body table-responsive no-padding">
									<table class="table table-hover">
										<tbody>
											<tr>
												<th>ID</th>
												<th>Subject</th>
												<th>Message</th>
												<th>Scheduled For</th>
												<th>Total Receipients</th>
												<th>Edit</th>
												<th>Delete</th>
											</tr>
											<?php
while ($fetch=mysqli_fetch_assoc($result)) {
											$id = $fetch['id'];
											$msg = $fetch['message'];
											$sender = $fetch['subject'];
											$sched_datetime = $fetch['schdtime'];
											$sms_count = $fetch['numberCount'];
											$msisdn = $fetch['msisdn'];
											?>
											<tr>
												<td><?php echo $id; ?></td>
												<td><?php echo $sender; ?></td>
												<td><?php echo $msg; ?></td>
												<td><?php echo $sched_datetime; ?></td>
												<td><?php echo $sms_count; ?></td>
												<td><button class="btn btn-block btn-info btn-sm" data-toggle="modal" data-target="#editModal" onclick="conf_edit('<?php echo $id; ?>','<?php echo $msisdn; ?>','<?php echo $sender; ?>','<?php echo $msg; ?>','<?php echo $sched_datetime; ?>')"><i class="glyphicon glyphicon-pencil"></i></button></td>
												<td><button class="btn btn-danger btn-info btn-sm" onclick="delJob('<?php echo $fetch['id']; ?>')"><i class="glyphicon glyphicon-trash"></i></button></td>
											</tr>
											<?php

											}
											?>
										</tbody>
									</table>
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						</div>
					</div>

					<!-- Main row -->

				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Create the tabs -->
				<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
					<li>
						<a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a>
					</li>
					<li>
						<a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a>
					</li>
				</ul>
				<!-- Tab panes -->
			</aside><!-- /.control-sidebar -->
			<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Edit Scheduled Message</h4>
			      </div>
			      <div class="modal-body">
					<form action="" method="post" role="form">
			       <div class="container-fluid">
						<div>
							<label for="number_single" class="control-label">Number(s)</label>
							<div class="">
								<input type="text" class="form-control col-sm-5 " name="number" id="number" required="required">
								<input type="hidden" id="row_id" name="row_id">
								<span class="help-block">numbers should be separated with a comma(,)</span>
							</div>
						</div>
						<div>
							<label for="number_single" class="control-label">Sender</label>
							<div class="">
								<input type="text" class="form-control col-sm-5 " name="sender" id="sender" required="required">
								<span class="help-block">&nbsp;</span>
							</div>
						</div>
						<div>
							<label for="number_single" class="control-label">Message</label>
							<div class="">
								<input type="text" class="form-control col-sm-5 " name="message" id="message" required="required">
								<span class="help-block">&nbsp;</span>
							</div>
						</div>
						<div>
							<label for="number_single" class="control-label">Schedule Time</label>
							<div class="">
								<input type="text" class="form-control" name="time" id="time" required="required" placeholder="edit schedule time">
							</div>
						</div>
					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>

		<!-- jQuery 2.1.4 -->
		<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
		<!-- Bootstrap 3.3.5 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<!-- Morris.js charts -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="plugins/morris/morris.min.js"></script>
		<!-- Sparkline -->
		<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
		<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- jQuery Knob Chart -->
		<script src="plugins/knob/jquery.knob.js"></script>
		<!-- daterangepicker -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
		<script src="plugins/daterangepicker/daterangepicker.js"></script>
		<!-- datepicker -->
		<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
		<!-- Bootstrap WYSIHTML5 -->
		<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<!-- Slimscroll -->
		<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="plugins/fastclick/fastclick.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/app.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="dist/js/pages/dashboard.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<script src="js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
		<script src="js/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>
		<script src="js/datetimepicker/jquery.datetimepicker.js" type="text/javascript"></script>

		<script>
			$(function() {
				$.datepicker.setDefaults({
					dateFormat : "yy-mm-dd"
				});
				$('#time').datetimepicker({

					hours12 : false,
					format : 'Y-m-d H:i',
					opened : false,
					validateOnBlur : false,
					closeOnDateSelect : false,
					closeOnTimeSelect : false,
					minDate : 0,
				});
			});

		</script>
		<script>
			function delJob(id) {
				var conf = confirm('Are you sure you want to delete this job');
				if (conf == true) {
					$.post('deleteJob.php', {
						key : id
					}, function(data) {
						alert(data);
						location.reload();
					});
				}
			}
		</script>
		<script type="text/javascript">
			function conf_edit(id, msisdn, sender, message, sched_datetime) {
				console.log(id);
				$('#row_id').val(id);
				$('#number').val(msisdn);
				$('#sender').val(sender);
				$('#message').val(message);
				$('#time').val(sched_datetime);
			}
		</script>
	</body>
</html>
