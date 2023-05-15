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
										<h3 class="content-title pull-left">Bonus Payments</h3>
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
													<th>Account Title</th>
													<th>Account No</th>
													<th>Amount</th>
													<th>Action</th>
													<th>Total Withdrwa</th>
													<th>Total Team</th>
													<th>User Name</th>
													<th>Account Name</th>
													<th>Available Balance</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($paymnets as $paymnet) { ?>
													<tr id="payment_<?= $paymnet->id ?>">
														<td class="center"><?= $paymnet->user_id ?></td>
														
														<td class="center"><?= $paymnet->account_title ?></td>
														<td class="center"><?= $paymnet->account_no ?></td>
														<td class="center"><?= $paymnet->amount ?></td>
														<td>
															<button onclick="approvedBonusPayment(<?= $paymnet->id ?>)" type="button" class="btn btn-warning">Approved</button>
														</td>
														<td class="center"><?= $paymnet->total_bonus_withdraw ?></td>
														<td class="center"><?= $paymnet->total_team ?></td>
														<td class="center"><?= $paymnet->user_name ?></td>
														<td class="center"><?= $paymnet->account_name ?></td>
														
														<td class="center"><?= $paymnet->user_bonus ?></td>
														< <td>
															<button onclick="rejectedBonusPayment(<?= $paymnet->id ?>)" type="button" class="btn btn-warning">Rejected</button>
															</td>
													</tr>
												<?php } ?>
											</tbody>
											<tfoot>
												<tr>
												<th>User Id</th>
													<th>Account Title</th>
													<th>Account No</th>
													<th>Amount</th>
													<th>Action</th>
													<th>Total Withdrwa</th>
													<th>Total Team</th>
													<th>User Name</th>
													<th>Account Name</th>
													<th>Available Balance</th>
													<th>Action</th>
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
	function approvedBonusPayment(id) {
		alert("Are You Sure?");
		fetch('/dashboard/approvedBonusPayment?payment_id=' + id)
			.then(data => {
				return data.json();
			})
			.then(post => {
				if (post == "Payment is Low") {
					document.getElementById("message").innerHTML = "User Send  Invalid Payment";
				} else {
					document.getElementById("payment_" + id).remove();
					document.getElementById("message").innerHTML = "Payment Approved Successfuly";
				}
			});
	}

	function rejectedBonusPayment(id) {
		alert("Are You Sure?");
		fetch('/dashboard/rejectedBonusPayment?payment_id=' + id)
			.then(data => {
				return data.json();
			})
			.then(post => {
				document.getElementById("payment_" + id).remove();
				document.getElementById("message").innerHTML = "Payment Rejected Successfuly";
			});
	}
</script>