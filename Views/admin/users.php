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
									<!-- <div class="description">Dynamic Tables and Modals</div> -->
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
										<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>User Id</th>
													<th>TxT Id</th>
													<th>Send No</th>
													<th>Total Team</th>
													<th>Name</th>
													<th>Refral Nmae</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Blocked</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($users as $user) { ?>
													<tr id="user_<?= $user->id ?>">
														<td class="center"><?= $user->id ?></td>
														<td class="center"><?= $user->txt_id ?></td>
														<td class="center"><?= $user->sender_no ?></td>
														<td class="center"><?= $user->total_team ?></td>
														<td class="center"><?= $user->name ?></td>
														<td class="center"><?= $user->invitee_name ?></td>
														<td class="center"><?= $user->email ?></td>
														<td class="center"><?= $user->phone ?></td>
														<td class="center" id="block_<?= $user->id ?>"><?= $user->blocked == 1 ? 'Yes' : 'No'  ?></td>
														<td>
															<i onclick="deleteUser(<?= $user->id ?>)" class="fa fa-trash"></i>
															<a href="edituser?id=<?= $user->id ?>"><i class="fa fa-edit"></i></a>
															<i onclick="blockUser(<?= $user->id ?>, <?= $user->blocked ?>)" class="fa fa-close"></i>
														</td>
													</tr>
												<?php } ?>
											</tbody>
											<tfoot>
												<tr>
													<th>User Id</th>
													<th>TxT Id</th>
													<th>Send No</th>
													<th>Total Team</th>
													<th>Name</th>
													<th>Refral Nmae</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Action</th>
												</tr>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
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
	function deleteUser(id) {
		alert("Are You Sure?");
		fetch('/dashboard/deleteUser?user_id=' + id)
			.then(data => {
				return data.json();
			})
			.then(post => {
				document.getElementById("user_" + id).remove();
				document.getElementById("message").innerHTML = "User Deleted Successfuly";
			});
	}

	function blockUser(id, blocked) {
		alert("Are You Sure?");
		fetch('/dashboard/blockUser?user_id=' + id)
			.then(data => {
				return data.json();
			})
			.then(post => {
				document.getElementById("block_" + id).innerHTML = blocked ? 'No' : 'Yes';
				document.getElementById("message").innerHTML = "User Blocked Successfuly";
			});
	}
</script>