<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>

<body>
	<!-- HEADER -->

	<!--/HEADER -->

	<!-- PAGE -->
	<section id="page">
		<?php
		include 'layouts/sidebar.php'
		?>
		<!-- /SIDEBAR -->
		<div id="main-content">
			<!-- SAMPLE BOX CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="box-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Box Settings</h4>
						</div>
						<div class="modal-body">
							Here goes box setting content.
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</div>
			</div>
			<!-- /SAMPLE BOX CONFIGURATION MODAL FORM-->
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12">
						<!-- PAGE HEADER-->
						<div class="row">
							<div class="col-sm-12">
								<div class="page-header">
									<!-- STYLER -->

									<!-- /STYLER -->
									<!-- BREADCRUMBS -->
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Users</h3>
									</div>
									<div class="text-right">
										<li class="breadcrumb-item pm-5"><button type="button" id="rejectBtn" class="btn btn-primary">Rejects User</button></li>
										<!-- <div class="description">Dynamic Tables and Modals</div> -->
									</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<!-- DATA TABLES -->
						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border green">
									<div class="box-title">
										<?php if ($message) { ?> <h4><?= $message ?></h4> <?php } ?>
										<h4 id="message"></h4>
										<div class="tools hidden-xs">
											<a href="#box-config" data-toggle="modal" class="config">
												<i class="fa fa-cog"></i>
											</a>
											<a href="javascript:;" class="reload">
												<i class="fa fa-refresh"></i>
											</a>
											<a href="javascript:;" class="collapse">
												<i class="fa fa-chevron-up"></i>
											</a>
											<a href="javascript:;" class="remove">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>

									<div class="box-body">
										<table id="example" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Txt Id</th>
													<th>Name</th>
													<th>Refral Name</th>
													<th>Email</th>
													<th>Sender No</th>
													<th>Approved</th>
													<th>Rejected</th>
													<th>Seelect Approved</th>
													<th>Select Rejected</th>
													<th>Phone</th>

												</tr>
											</thead>
											<tbody>
												<?php foreach ($users as $user) { ?>
													<tr id="user_<?= $user->id ?>">
													<td class="center"><?= $user->txt_id ?></td>
														<td class="center"><?= $user->name ?></td>
														<td class="center"><?= $user->invitee_name ?></td>
														<td class="center"><?= $user->email ?></td>
														<td class="center"><?= $user->sender_no ?></td>
														<td>
															<button onclick="approvedUser(<?= $user->id ?>)" type="button" class="btn btn-warning">Approved</button>
														</td>
														<td><button onclick="rejectedUser(<?= $user->id ?>)" type="button" class="btn btn-warning">Rejected</button></td>
														<td>
															<div class="form-check ">
																<input class="form-check-input" type="checkbox" onChange="toggleAprroveSelect(<?= $user->id ?>)">
															</div>

														</td>
														<td>
															<div style="text-align:center" class="dropdown">
																<input class="form-check-input" type="checkbox" onChange="toggleRejectSelect(<?= $user->id ?>)">
															</div>
														</td>
														<td class="center"><?= $user->account_no ?></td>

													</tr>
												<?php } ?>
											</tbody>
											<tfoot>
												<tr>
													<th>Txt Id</th>
													<th>Name</th>
													<th>Refral Name</th>
													<th>Email</th>
													<th>Sender No</th>
													<th>Approved</th>
													<th>Rejected</th>
													<th>Seelect Approved</th>
													<th>Select Rejected</th>
													<th>Phone</th>
												</tr>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>

						<li class="breadcrumb-item"><button type="button" id="approveBtn" class="btn btn-primary">Approved User</button></li>
						<!-- /DATA TABLES -->
						<div class="separator"></div>
						<!-- TABLE IN MODAL -->

						<!-- /TABLE IN MODAL -->
						<!-- SAMPLE BOX CONFIGURATION MODAL FORM-->

						<!-- /EXPORT TABLES -->
						<div class="footer-tools">
							<span class="go-top">
								<i class="fa fa-chevron-up"></i> Top
							</span>
						</div>
					</div><!-- /CONTENT-->
				</div>
			</div>
		</div>
	</section>
	<!--/PAGE -->
	<?php include 'layouts/scripts.php' ?>
</body>

</html>
<script>
	const apprroveIDs = [];

	const toggleAprroveSelect = (id) => {

		const idIndex = apprroveIDs.indexOf(id);

		if (idIndex > -1) {
			apprroveIDs.splice(idIndex, 1);
		} else {
			apprroveIDs.push(id);
		}

	}

	const approveBtn = document.querySelector("#approveBtn");

	const approve = () => {
		if (!apprroveIDs.length) {
			alert('Please select users to approve');
			return false;
		}

		fetch('/dashboard/approvedUser?user_id=' + apprroveIDs)
			.then(data => {
				return data.json();
			})
			.then(post => {
				window.location.reload();
			});
	}
	approveBtn.addEventListener('click', approve);



	const rejectIDs = [];

	const toggleRejectSelect = (id) => {

		const idIndex = rejectIDs.indexOf(id);

		if (idIndex > -1) {
			rejectIDs.splice(idIndex, 1);
		} else {
			rejectIDs.push(id);
		}

	}

	const rejectBtn = document.querySelector("#rejectBtn");

	const reject = () => {
		if (!rejectIDs.length) {
			alert('Please select users to Reject');
			return false;
		}
		fetch('/dashboard/RejectedUsers?user_id=' + rejectIDs)
			.then(data => {
				return data.json();
			})
			.then(post => {
				window.location.reload();
			});
	}
	rejectBtn.addEventListener('click', reject);

	function approvedUser(id) {
		const apprroveIDs = [];

		const idIndex = apprroveIDs.indexOf(id);
		if (idIndex > -1) {
			apprroveIDs.splice(idIndex, 1);
		} else {
			apprroveIDs.push(id);
		}
		fetch('/dashboard/approvedUser?user_id=' + id)
			.then(data => {
				return data.json();
			})
			.then(post => {
				document.getElementById("user_" + id).remove();
				document.getElementById("message").innerHTML = "User Approved Successfuly";
			});
	}

	function rejectedUser(id) {
		alert("Are You Sure?");
		fetch('/dashboard/RejectedUsers?user_id=' + id)
			.then(data => {
				return data.json();
			})
			.then(post => {
				document.getElementById("user_" + id).remove();
				document.getElementById("message").innerHTML = "User Rejected Successfuly";
			});
	}
</script>