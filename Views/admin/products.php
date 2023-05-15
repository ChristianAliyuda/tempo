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
										<h3 class="content-title pull-left">Products</h3>
									</div>
									<div class="text-right">
										<a href="/dashboard/addproduct">
											<button type="button" class="btn btn-primary">Add Products</button>
										</a>
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
										<table id="example" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Link</th>
													<th>Image</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($products as $product) { ?>
													<tr id="product_<?= $product->id ?>">
													<td class="center"><?= $product->link ?></td>
														<td class="center"><img src="../<?= $product->logo ?>" width="200" height="200"></td>
														<td>
															<i onclick="deleteProduct(<?= $product->id ?>)" class="fa fa-trash"></i>
															<a href="/dashboard/editproducts?id=<?= $product->id ?>"><i class="fa fa-edit"></i></a>
														</td>
													</tr>
												<?php } ?>
											</tbody>
											<tfoot>
												<tr>
													<th>Video</th>
													<th>Level</th>
													<th>Amount</th>
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
	function deleteProduct(id) {
		alert("Are You Sure?");
		fetch('/dashboard/deleteProduct?product_id=' + id)
			.then(data => {
				return data.json();
			})
			.then(post => {
				document.getElementById("product_" + id).remove();
				document.getElementById("message").innerHTML = "Product Deleted Successfuly";
			});
	}
</script>