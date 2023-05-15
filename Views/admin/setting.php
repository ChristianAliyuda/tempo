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
										<h3 class="content-title pull-left">Setting</h3>
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
										<h4><i class="fa fa-table"></i>Setting</h4>
										<?php foreach ($errors as $error) { ?>
											<p><?= $error ?></p> <?php
																} ?>
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
									<div class="box-body big">
										<?php if ($message) { ?> <h4><?= $message ?></h4> <?php } ?>
										<form role="form" method="POST" action="updatesetting" enctype="multipart/form-data">

											<input type="hidden" name="id" value="<?= $setting->id ?>">
											<div class="form-group">
												<label for="exampleInputEmail1">Registeration Fees</label>
												<input type="text" class="form-control" value="<?= $setting->register_fees ?>" name="register_fees" id="exampleInputEmail1" placeholder="Registeration Fees">
											</div>

											<div class="form-group">
												<label for="exampleInputPassword1">Account Ttile</label>
												<input type="text" class="form-control" required name="easypiasa_title" value="<?= $setting->easypiasa_title ?>" id="exampleInputPassword1" placeholder="Account Ttile">
											</div>
											<div class="form-group">
												<label for="exampleInputPassword1">Account No</label>
												<input type="text" class="form-control" required name="easypiasa_no" value="<?= $setting->easypiasa_no ?>" id="exampleInputPassword1" placeholder="Account No">
											</div>

											<div class="form-group">
												<label for="exampleInputPassword1">Email</label>
												<input type="text" class="form-control" required name="email" value="<?= $setting->email ?>" id="exampleInputPassword1" placeholder="Email">
											</div>

											<div class="form-group">
												<label for="exampleInputPassword1">Whatsapp Group</label>
												<input type="text" class="form-control" required name="whatsapp_link" value="<?= $setting->whatsapp_link ?>" id="exampleInputPassword1" placeholder="Whatsapp Group">
											</div>

											<div class="form-group">
												<label for="exampleInputPassword1">Dollar Rate</label>
												<input type="text" class="form-control" required name="dollar_rate" value="<?= $setting->dollar_rate ?>" id="exampleInputPassword1" placeholder="Email">
											</div>

											<!-- <div class="form-group">
												<label for="exampleInputPassword1">First Team Reward</label>
												<input type="text" class="form-control" required name="first_reward" value="<?= $setting->first_reward ?>" id="exampleInputPassword1" placeholder="Reward">
											</div>
											<div class="form-group">
												<label for="exampleInputPassword1">Second Reward</label>
												<input type="text" class="form-control" required name="second_reward" value="<?= $setting->second_reward ?>" id="exampleInputPassword1" placeholder="Reward">
											</div>
											<div class="form-group">
												<label for="exampleInputPassword1">Third Reward</label>
												<input type="text" class="form-control" required name="third_reward" value="<?= $setting->third_reward ?>" id="exampleInputPassword1" placeholder="Reward">
											</div>

											<div class="form-group">
												<label for="exampleInputPassword1">Total Team Reward</label>
												<input type="text" class="form-control" disabled required name="total_team_reward" value="<?= $setting->total_team_reward ?>" id="exampleInputPassword1" placeholder="Reward">
											</div> -->

											<div class="form-group">
												<label for="exampleInputPassword1">Account Change Minutes</label>
												<input type="text" class="form-control" required name="change_hour" value="<?= $setting->change_hour ?>" id="exampleInputPassword1" placeholder="Reward">
											</div>


											<div class="form-group">
												<label for="exampleFormControlTextarea3">Heading</label>
												<textarea id="editor" name="message2" rows="7"><?= $setting->message2 ?></textarea>
											</div>



											<div class="form-group">
												<label for="exampleFormControlTextarea3">Description Payment</label>
												<textarea id="editor" name="about" rows="7"><?= $setting->about ?></textarea>
											</div>

											<div class="checkbox">
												<label>
													<input type="checkbox"> Check me out
												</label>
											</div>
											<button type="submit" class="btn btn-success">Submit</button>
										</form>
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