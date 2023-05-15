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


								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<!-- DASHBOARD CONTENT -->
						<div class="row">
							<!-- COLUMN 1 -->
							<div class="col-md-12">
								<div class="row">
									<div class="col-lg-4">
										<div class="dashbox panel panel-default">
											<div class="panel-body">
												<div class="panel-left red">
													<i class="fa fa-user fa-3x"></i>
												</div>
												<div class="panel-right">
													<div class="number"><?= $data["approved_users"] ?></div>
													<div class="title">Approved User</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="dashbox panel panel-default">
											<div class="panel-body">
												<div class="panel-left blue">
													<i class="fa fa-user fa-3x"></i>
												</div>
												<div class="panel-right">
													<div class="number"><?= $data["pending_users"] ?></div>
													<div class="title">Total Pending User</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="dashbox panel panel-default">
											<div class="panel-body">
												<div class="panel-left blue">
													<i class="fa fa-credit-card  fa-3x"></i>
												</div>
												<div class="panel-right">
													<div class="number"><?= $data["total_withdraw"] ?></div>
													<div class="title">Total Withdraw</div>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
							<!-- /COLUMN 1 -->

						</div>
						<div class="row">
							<!-- COLUMN 1 -->
							<div class="col-md-12">
								<div class="row">
									<div class="col-lg-4">
										<div class="dashbox panel panel-default">
											<div class="panel-body">
												<div class="panel-left red">
													<i class="fa fa-user fa-3x"></i>
												</div>
												<div class="panel-right">
													<div class="number"><?= $data["users"] ?></div>
													<div class="title">Total User</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="dashbox panel panel-default">
											<div class="panel-body">
												<div class="panel-left blue">
													<i class="fa fa-credit-card  fa-3x"></i>
												</div>
												<div class="panel-right">
													<div class="number"><?= $data["approved_users"] * 3 ?></div>
													<div class="title">Total Received Payment</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="dashbox panel panel-default">
											<div class="panel-body">
												<div class="panel-left blue">
													<i class="fa fa-video-camera  fa-3x"></i>
												</div>
												<div class="panel-right">
													<div class="number"><?= $data["videos"] ?></div>
													<div class="title">Total Videos</div>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
							<!-- /COLUMN 1 -->

						</div>
						<div class="row">
							<!-- COLUMN 1 -->
							<div class="col-md-12">
								<div class="row">
									<div class="col-lg-4">
										<div class="dashbox panel panel-default">
											<div class="panel-body">
												<div class="panel-left red">
													<i class="fa fa-user fa-3x"></i>
												</div>
												<div class="panel-right">
													<div class="number"><?= $data["dollar"] ?></div>
													<div class="title">Today Dollar Rate</div>
												</div>
											</div>
										</div>
									</div>



								</div>

							</div>
							<!-- /COLUMN 1 -->

						</div>

						<!-- /DASHBOARD CONTENT -->
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
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<?php include 'layouts/scripts.php' ?>
</body>

</html>