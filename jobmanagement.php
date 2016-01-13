<?php
session_start();
if(isset($_SESSION['user'])){
	$user_sess = $_SESSION['user'];
} else
	{
		header('Location: login.php');
	}
require_once('core/connection.php');
require_once('core/functions.php');


if(isset($_POST['conf_del']))
{
	$id = $_POST['id_hidden'];

	if(mysqli_query($con, "DELETE FROM jobs WHERE id = '$id'"))
	{
		$_SESSION['type']= 'warning';
		$_SESSION['alert']= 'Scheduled message has been deleted';
	}

}

if(isset($_POST['conf_sch_del']))
{
	$id = $_POST['id_hidden'];

	if(mysqli_query($con, "DELETE FROM q_msgs WHERE id = '$id'"))
	{
		$_SESSION['type']= 'warning';
		$_SESSION['alert']= 'Queued message has been deleted';
	}

}

if(isset($_POST['edit'])){

	$id = $_POST['row_id'];
	$msisdn = $_POST['number'];
	$sender = $_POST['sender'];
	$sched_datetime = $_POST['time'];

	$q = "UPDATE jobs SET msisdn='$msisdn', sender='$sender', sched_datetime='$sched_datetime' WHERE id='$id'";

	if(mysqli_query($con, $q)){
		$_SESSION['type']= 'success';
		$_SESSION['alert']= 'Scheduled message has been edited';
	} else {
		$_SESSION['type']= 'danger';
		$_SESSION['alert']= 'Scheduled message could not be edited';
	}

}

// if(isset($_POST['search'])){

// 	if(isset($_POST['msg'])){

// 		$msg_post = $_POST['msg'];

// 	$sql = "SELECT * FROM jobs WHERE message LIKE '%$msg_post%' AND username = '$user_sess'";

// 	}
// 	if(isset($_POST['sender'])){

// 		$sender_post = $_POST['sender'];

// 	$sql = "SELECT * FROM jobs WHERE sender LIKE '%$sender_post%' AND username = '$user_sess'";

// 	}
// }

?>

<html>
	<head>
		<title>Nalo - Job Management</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/dashboard.css" rel="stylesheet">
		<link type="text/css" href="css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
        <!--    PACE-->
        <script src="js/pace.min.js"></script>
        <link href="css/pace-flash.css" rel="stylesheet" />
        <!--    END PACE-->
		<link href="js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">

		<link href="css/jquery.dataTables.css" rel="stylesheet">
		<link type="text/css" href="css/dataTables.tableTools.css" rel="stylesheet" />
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand"><img src="img/logo.png" style="height:35px;width:100px;"></a>
				</div>
				<div class="navbar-collapse collapse">
		          <ul class="nav navbar-nav navbar-left">
		            <li><a href="sendsms.php">Send SMS</a></li>
		            <li><a href="sendsms_grp.php">Bulk</a></li>
		            <li class="active"><a href="jobmanagement.php">Job Management</a></li>
		            <li><a href="addressbook.php">Address Book</a></li>
		            <li><a href="reports.php">Reports</a></li>
		            <li><a href="userprofile.php">User Profile</a></li>
		            <li><a href="troubletickets/submitticket.php">Submit Ticket</a></li>
		          </ul>
		          <p class="navbar-text navbar-right" style="margin:0px"> <a href="" class="btn btn-info navbar-btn"><i class="glyphicon glyphicon-refresh" tooltip="Refresh"></i></a></p> 
		        </div>
			</div>
		</div>
		<div class="container-fluid">
		<?php require_once('core/user_info_query.php'); ?>
		<div class="row">
		<?php require_once('core/user_info.php'); ?>
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li>
							<a href="sendsms.php"><i class='glyphicon glyphicon-envelope'></i> Send SMS</a>
						</li>
						<li>
							<a href="sendsms_grp.php"><i class='glyphicon glyphicon-envelope'></i>Bulk<sup style="color: red;">over 500000 contact</sup></a>
						</li>
						<li class="active">
							<a href="jobmanagement.php"><i class='glyphicon glyphicon-calendar'></i> Job Management</a>
						</li>
						<li>
							<a href="addressbook.php"><i class='glyphicon glyphicon-book'></i> Address Book</a>
						</li>
						<li>
							<a href="reports.php"><i class='glyphicon glyphicon-stats'></i> Reports</a>
						</li>
						<li>
							<a href="userprofile.php"><i class='glyphicon glyphicon-user'></i> User Profile</a>
						</li>
						<li>
							<a href="troubletickets/submitticket.php"><i class='glyphicon glyphicon-record'></i> Submit Ticket</a>
						</li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<ul class="nav nav-tabs">
					<li>
						<a href="#sch" data-toggle="tab">Scheduled Messages</a>
					</li>
					<li class="active">
  						<a href="#que" data-toggle="tab">Queued Messages</a>
  					</li>
					</ul>
					<!-- Tab panes -->
				<div class="tab-content">
				  <div class="tab-pane fade" id="sch">
					
					<hr />
				<!--
				<div class="panel panel-default">
					<div class="panel-heading">
						Search Category
					</div>
					<div class="panel-body">
				<div class="col-md-6">
				<form action="" role="form" method="post">
					<div class="form-group">
						<label for="sender_single" class="col-sm-3 control-label">Message</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="msg" >
							</div>
					</div>
					<br /><br />
					<div class="form-group">
						<label for="sender_single" class="col-sm-3 control-label">Date From</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="datepicker" name="date_from" >
							</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="sender_single" class="col-sm-3 control-label">Sender</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="sender" >
							</div>
					</div>
					<br /><br />
					<div class="form-group">
						<label for="sender_single" class="col-sm-3 control-label">Date To</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="date_to" >
							</div>
					</div>
				</div>
				<br /><br /><br /><br /><br /><br />				
				<div align="center"><button type="submit" name="search" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Search</button></div>							
				</form>
				</div>
				</div>-->
					<table id="example2" class="display" cellspacing="0" width="100%" style="font-size:13px;">
							    <thead>
							        <tr>
							        	<!-- <th>No.</th> -->
							            <th>Sender</th>
							        	<th>Message</th>
							            <th>Message Length</th>
							            <th>Status</th>
							            <th>Total Destination</th>
							            <th>Scheduled Time</th>
							            <th style="width:100px;">Actions</th>
							        </tr>
							    </thead>
							    <tbody id="tbody">
									
									<?php
									if(!isset($_POST['search'])){
										$sql = "SELECT * FROM jobs WHERE username = '$user_sess' AND status <> 'completed' ORDER BY id DESC";
									}
										$result = mysqli_query($con, $sql);

										while($row = mysqli_fetch_array($result))
										{	
											$id = $row['id'];
											$msg = $row['message'];
											$sender = $row['sender'];
											$sched_datetime = $row['sched_datetime'];
											$sms_count = $row['sms_count'];
											$msisdn = $row['msisdn'];
											$status = $row['status'];

											$nums = explode(',', $msisdn);
											$no_conts = count($nums);
										?>
										<tr>
											<!-- <td></td> -->
											<td><?php echo $sender; ?></td>
											<td><?php echo $msg; ?></td>
											<td><?php echo $sms_count." pages"; ?></td>
											<td><?php echo $status ?></td>
											<td><?php echo $no_conts; ?></td>
											<td><?php echo $sched_datetime; ?></td>
											<td>
												<button class="btn btn-primary" data-toggle="modal" data-target="#editModal" onclick="conf_edit('<?php echo $id; ?>','<?php echo $msisdn; ?>','<?php echo $sender; ?>','<?php echo $sched_datetime; ?>')"><i class="glyphicon glyphicon-pencil"></i></button>
												<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="conf_delete('<?php echo $id; ?>','<?php echo $sched_datetime; ?>')"><i class="glyphicon glyphicon-trash"></i></button>
											</td>
										</tr>
									<?php
										}
									?>
							    </tbody>
							</table>
						</div>
						 <div class="tab-pane fade in active" id="que">
						 <?php
							if (isset($_SESSION['alert'])) {
							echo '<br />';
										$type = $_SESSION['type'];
										$msg = $_SESSION['alert'];
										echo show_alert($type, $msg);
										unset($_SESSION['type']);
										unset($_SESSION['alert']);
									}
						?>
						 <hr />
						 <!-- <div class="pull-left">
						 <button class="btn btn-info" onclick="send_btn('all')"><i class="glyphicon glyphicon-envelope"></i> Send All</button>
						 <br /><br />
						 </div> -->
						 	<table id="example" class="display" cellspacing="0" width="100%" style="font-size:13px;table-layout:fixed;">
							    <thead>
							        <tr>
							        	<!-- <th>No.</th> -->
							            <th>Sender</th>
							        	<th style="width:100px;">Message</th>
							            <th>Message Length</th>
							            <th>Status</th>
							            <th>Total Destination</th>
							            <th>Date Time</th>
							            <th>Actions</th>
							        </tr>
							    </thead>
							    <tbody id="tbody">
									
									<?php
									if(!isset($_POST['search'])){
										$sql = "SELECT * FROM q_msgs WHERE username = '$user_sess' ORDER BY id DESC";
									}
										$result = mysqli_query($con, $sql);

										while($row = mysqli_fetch_array($result))
										{	
											$id = $row['id'];
											$msg = $row['msg'];
											$sender = $row['sender'];
											$datetime = $row['datetime'];
											$sms_count = $row['sms_count'];
											$msisdn = $row['msisdn'];
											$status = $row['status'];

											$nums = explode(',', $msisdn);
											$no_conts = count($nums);
										?>
										<tr>
											<!-- <td></td> -->
											<td><?php echo $sender; ?></td>
											<td style="overflow:hidden;width:100px;"><?php echo $msg; ?></td>
											<td><?php echo $sms_count." pages"; ?></td>
											<td><?php echo $status ?></td>
											<td><?php echo $no_conts; ?></td>
											<td><?php echo $datetime; ?></td>
											<td>
												<button class="btn btn-success" data-toggle="modal" onclick="send_btn('<?php echo $id; ?>')"><i class="glyphicon glyphicon-envelope"></i></button>
												<button class="btn btn-danger" data-toggle="modal" data-target="#deleteSchModal" onclick="conf_sch_delete('<?php echo $id; ?>','<?php echo $datetime; ?>')"><i class="glyphicon glyphicon-trash"></i></button>
											</td>
										</tr>
									<?php
										}
									?>
							    </tbody>
							</table>
						 </div>
					</div>
				</div>
			</div>
		</div>

			<!-- edit Modal -->
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




		<!-- delete modal -->
		<div class="modal fade bs-example-modal-sm" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
			  </div>
				<div class="modal-body">
				  Are you sure you want to delete this message scheduled for <strong><span id="del_span"></span></strong>?
				</div>
				<div class="modal-footer">
					<form action="" method="post" class="form-inline" role="form"> 
					<button type="button" class="btn btn-success" data-dismiss="modal">No</button>
					<input type="hidden" id="id_hidden" name="id_hidden">
					<button type="submit" name="conf_del" id="conf_del" class="btn btn-danger">Yes</button>
					</form>
				</div>
			</div>
		  </div>
		</div>

		<!-- delete schedule modal -->
		<div class="modal fade bs-example-modal-sm" id="deleteSchModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
			  </div>
				<div class="modal-body">
				  Are you sure you want to delete this message queued at <strong><span id="del_sch_span"></span></strong>?
				</div>
				<div class="modal-footer">
					<form action="" method="post" class="form-inline" role="form"> 
					<button type="button" class="btn btn-success" data-dismiss="modal">No</button>
					<input type="hidden" id="id_sch_hidden" name="id_hidden">
					<button type="submit" name="conf_sch_del" id="conf_sch_del" class="btn btn-danger">Yes</button>
					</form>
				</div>
			</div>
		  </div>
		</div>
		<!-- loading modal schedule modal -->
		<div class="modal fade bs-example-modal-sm" id="loadingModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="mySmallModalLabel" aria-hidden="false">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body" id="m_body">
				<p style="text-align:center;font-size:1.5em;">
				<span>sending... <img src="img/ajax-loader.gif"/></span>
				</p>
				</div>
			</div>
		  </div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-1.8.2.js" type="text/javascript"></script>
		<script src="js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
		<script src="js/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>


		<script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
		<script src="js/dataTables.tableTools.js"></script>

		<script src="js/datetimepicker/jquery.datetimepicker.js" type="text/javascript"></script>

		<script type="text/javascript">
			function send_btn(id) {
				$('#loadingModal').modal('show');
				
				$.post("process_q.php", 
					{ id : id }, 
					function(data) {
					//alert(data);
					
					if(data){
						$('#loadingModal').modal('show');
						$('#m_body').html('<p style="text-align:center;font-size:1.3em;">'+data+'</p>');
						setTimeout(function(){ //closes modal after 5 seconds
						    $('#loadingModal').modal('hide');
						    location.reload();//reloads page
						}, 5000);

					} else {
						$('#loadingModal').modal('hide');
					}

					// $('#stats').load('core/user_info.php');

				});
			 }
		</script>
		
		<script type="text/javascript">
    	$(document).ready(function() {
	    	$('#example').DataTable( {
		    } );
		} );
		$(document).ready(function() {
	    	$('#example2').DataTable( {
		    } );
		} );
    	</script>

		<script>
			$(function(){
			  $.datepicker.setDefaults(
			    $.extend( $.datepicker.regional[ '' ] )
			  );
			  $('#datepicker').datepicker();
			  $('#datepicker1').datepicker();
			});
		</script>

		<script>
			function conf_delete(id, name) {
				$('#id_hidden').val(id);
				$('#del_span').text(name);
			}

			function conf_sch_delete(id, name) {
				$('#id_sch_hidden').val(id);
				$('#del_sch_span').text(name);
			}
		</script>

		<script type="text/javascript">
		$(function() {
			$.datepicker.setDefaults({
				dateFormat : "yy-mm-dd"
			});
			$('#time').datetimepicker({

			  	hours12: false,
		        format: 'Y-m-d H:i',
		        step: 1,
		        opened: false,
		        validateOnBlur: false,
		        closeOnDateSelect: false,
		        closeOnTimeSelect: false,
		        minDate: 0,
		        minTime: 0
			});
		});
		</script>

		<script type="text/javascript">
		function conf_edit(id,msisdn, sender, sched_datetime){
			$('#row_id').val(id);
			$('#number').val(msisdn);
			$('#sender').val(sender);
			$('#time').val(sched_datetime);
		}
		</script>
		<?php mysqli_close($con); ?>
	</body>
</html>