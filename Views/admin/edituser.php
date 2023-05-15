<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php' ?>

<body>
	<!-- HEADER -->
	<header class="navbar clearfix" id="header">
		<div class="container">
			<div class="navbar-brand">
				<!-- COMPANY LOGO -->
				<a href="index.html">
					<img src="/assets/img/logo/logo.png" alt="Cloud Admin Logo" class="img-responsive" height="30" width="120">
				</a>
				<!-- /COMPANY LOGO -->
				<!-- TEAM STATUS FOR MOBILE -->
				<div class="visible-xs">
					<a href="#" class="team-status-toggle switcher btn dropdown-toggle">
						<i class="fa fa-users"></i>
					</a>
				</div>
				<!-- /TEAM STATUS FOR MOBILE -->
				<!-- SIDEBAR COLLAPSE -->
				<div id="sidebar-collapse" class="sidebar-collapse btn">
					<i class="fa fa-bars" data-icon1="fa fa-bars" data-icon2="fa fa-bars"></i>
				</div>
				<!-- /SIDEBAR COLLAPSE -->
			</div>
			<!-- NAVBAR LEFT -->
			<ul class="nav navbar-nav pull-left hidden-xs" id="navbar-left">
				<li class="dropdown">
					<a href="#" class="team-status-toggle dropdown-toggle tip-bottom" data-toggle="tooltip" title="Toggle Team View">
						<i class="fa fa-users"></i>
						<span class="name">Team Status</span>
						<i class="fa fa-angle-down"></i>
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-cog"></i>
						<span class="name">Skins</span>
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu skins">
						<li class="dropdown-title">
							<span><i class="fa fa-leaf"></i> Theme Skins</span>
						</li>
						<li><a href="#" data-skin="default">Subtle (default)</a></li>
						<li><a href="#" data-skin="night">Night</a></li>
						<li><a href="#" data-skin="earth">Earth</a></li>
						<li><a href="#" data-skin="utopia">Utopia</a></li>
						<li><a href="#" data-skin="nature">Nature</a></li>
						<li><a href="#" data-skin="graphite">Graphite</a></li>
					</ul>
				</li>
			</ul>
			<!-- /NAVBAR LEFT -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<li class="dropdown" id="header-notification">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell"></i>
						<span class="badge">7</span>

					</a>
					<ul class="dropdown-menu notification">
						<li class="dropdown-title">
							<span><i class="fa fa-bell"></i> 7 Notifications</span>
						</li>
						<li>
							<a href="#">
								<span class="label label-success"><i class="fa fa-user"></i></span>
								<span class="body">
									<span class="message">5 users online. </span>
									<span class="time">
										<i class="fa fa-clock-o"></i>
										<span>Just now</span>
									</span>
								</span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="label label-primary"><i class="fa fa-comment"></i></span>
								<span class="body">
									<span class="message">Martin commented.</span>
									<span class="time">
										<i class="fa fa-clock-o"></i>
										<span>19 mins</span>
									</span>
								</span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="label label-warning"><i class="fa fa-lock"></i></span>
								<span class="body">
									<span class="message">DW1 server locked.</span>
									<span class="time">
										<i class="fa fa-clock-o"></i>
										<span>32 mins</span>
									</span>
								</span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="label label-info"><i class="fa fa-twitter"></i></span>
								<span class="body">
									<span class="message">Twitter connected.</span>
									<span class="time">
										<i class="fa fa-clock-o"></i>
										<span>55 mins</span>
									</span>
								</span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="label label-danger"><i class="fa fa-heart"></i></span>
								<span class="body">
									<span class="message">Jane liked. </span>
									<span class="time">
										<i class="fa fa-clock-o"></i>
										<span>2 hrs</span>
									</span>
								</span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="label label-warning"><i class="fa fa-exclamation-triangle"></i></span>
								<span class="body">
									<span class="message">Database overload.</span>
									<span class="time">
										<i class="fa fa-clock-o"></i>
										<span>6 hrs</span>
									</span>
								</span>
							</a>
						</li>
						<li class="footer">
							<a href="#">See all notifications <i class="fa fa-arrow-circle-right"></i></a>
						</li>
					</ul>
				</li>
				<!-- END NOTIFICATION DROPDOWN -->
				<!-- BEGIN INBOX DROPDOWN -->
				<li class="dropdown" id="header-message">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope"></i>
						<span class="badge">3</span>
					</a>
					<ul class="dropdown-menu inbox">
						<li class="dropdown-title">
							<span><i class="fa fa-envelope-o"></i> 3 Messages</span>
							<span class="compose pull-right tip-right" title="Compose message"><i class="fa fa-pencil-square-o"></i></span>
						</li>
						<li>
							<a href="#">
								<img src="/assets/img/avatars/avatar2.jpg" alt="" />
								<span class="body">
									<span class="from">Jane Doe</span>
									<span class="message">
										Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mole ...
									</span>
									<span class="time">
										<i class="fa fa-clock-o"></i>
										<span>Just Now</span>
									</span>
								</span>

							</a>
						</li>
						<li>
							<a href="#">
								<img src="/assets/img/avatars/avatar1.jpg" alt="" />
								<span class="body">
									<span class="from">Vince Pelt</span>
									<span class="message">
										Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mole ...
									</span>
									<span class="time">
										<i class="fa fa-clock-o"></i>
										<span>15 min ago</span>
									</span>
								</span>

							</a>
						</li>
						<li>
							<a href="#">
								<img src="/assets/img/avatars/avatar8.jpg" alt="" />
								<span class="body">
									<span class="from">Debby Doe</span>
									<span class="message">
										Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mole ...
									</span>
									<span class="time">
										<i class="fa fa-clock-o"></i>
										<span>2 hours ago</span>
									</span>
								</span>

							</a>
						</li>
						<li class="footer">
							<a href="#">See all messages <i class="fa fa-arrow-circle-right"></i></a>
						</li>
					</ul>
				</li>
				<!-- END INBOX DROPDOWN -->
				<!-- BEGIN TODO DROPDOWN -->
				<li class="dropdown" id="header-tasks">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-tasks"></i>
						<span class="badge">3</span>
					</a>
					<ul class="dropdown-menu tasks">
						<li class="dropdown-title">
							<span><i class="fa fa-check"></i> 6 tasks in progress</span>
						</li>
						<li>
							<a href="#">
								<span class="header clearfix">
									<span class="pull-left">Software Update</span>
									<span class="pull-right">60%</span>
								</span>
								<div class="progress">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
										<span class="sr-only">60% Complete</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="header clearfix">
									<span class="pull-left">Software Update</span>
									<span class="pull-right">25%</span>
								</span>
								<div class="progress">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
										<span class="sr-only">25% Complete</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="header clearfix">
									<span class="pull-left">Software Update</span>
									<span class="pull-right">40%</span>
								</span>
								<div class="progress progress-striped">
									<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
										<span class="sr-only">40% Complete</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="header clearfix">
									<span class="pull-left">Software Update</span>
									<span class="pull-right">70%</span>
								</span>
								<div class="progress progress-striped active">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
										<span class="sr-only">70% Complete</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="header clearfix">
									<span class="pull-left">Software Update</span>
									<span class="pull-right">65%</span>
								</span>
								<div class="progress">
									<div class="progress-bar progress-bar-success" style="width: 35%">
										<span class="sr-only">35% Complete (success)</span>
									</div>
									<div class="progress-bar progress-bar-warning" style="width: 20%">
										<span class="sr-only">20% Complete (warning)</span>
									</div>
									<div class="progress-bar progress-bar-danger" style="width: 10%">
										<span class="sr-only">10% Complete (danger)</span>
									</div>
								</div>
							</a>
						</li>
						<li class="footer">
							<a href="#">See all tasks <i class="fa fa-arrow-circle-right"></i></a>
						</li>
					</ul>
				</li>
				<!-- END TODO DROPDOWN -->
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<li class="dropdown user" id="header-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img alt="" src="/assets/img/avatars/avatar3.jpg" />
						<span class="username">John Doe</span>
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="fa fa-user"></i> My Profile</a></li>
						<li><a href="#"><i class="fa fa-cog"></i> Account Settings</a></li>
						<li><a href="#"><i class="fa fa-eye"></i> Privacy Settings</a></li>
						<li><a href="login.html"><i class="fa fa-power-off"></i> Log Out</a></li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
			<!-- END TOP NAVIGATION MENU -->
		</div>

		<!-- TEAM STATUS -->
		<div class="container team-status" id="team-status">
			<div id="scrollbar">
				<div class="handle">
				</div>
			</div>
			<div id="teamslider">
				<ul class="team-list">
					<li class="current">
						<a href="javascript:void(0);">
							<span class="image">
								<img src="/assets/img/avatars/avatar3.jpg" alt="" />
							</span>
							<span class="title">
								You
							</span>
							<div class="progress">
								<div class="progress-bar progress-bar-success" style="width: 35%">
									<span class="sr-only">35% Complete (success)</span>
								</div>
								<div class="progress-bar progress-bar-warning" style="width: 20%">
									<span class="sr-only">20% Complete (warning)</span>
								</div>
								<div class="progress-bar progress-bar-danger" style="width: 10%">
									<span class="sr-only">10% Complete (danger)</span>
								</div>
							</div>
							<span class="status">
								<div class="field">
									<span class="badge badge-green">6</span> completed
									<span class="pull-right fa fa-check"></span>
								</div>
								<div class="field">
									<span class="badge badge-orange">3</span> in-progress
									<span class="pull-right fa fa-adjust"></span>
								</div>
								<div class="field">
									<span class="badge badge-red">1</span> pending
									<span class="pull-right fa fa-list-ul"></span>
								</div>
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image">
								<img src="/assets/img/avatars/avatar1.jpg" alt="" />
							</span>
							<span class="title">
								Max Doe
							</span>
							<div class="progress">
								<div class="progress-bar progress-bar-success" style="width: 15%">
									<span class="sr-only">35% Complete (success)</span>
								</div>
								<div class="progress-bar progress-bar-warning" style="width: 40%">
									<span class="sr-only">20% Complete (warning)</span>
								</div>
								<div class="progress-bar progress-bar-danger" style="width: 20%">
									<span class="sr-only">10% Complete (danger)</span>
								</div>
							</div>
							<span class="status">
								<div class="field">
									<span class="badge badge-green">2</span> completed
									<span class="pull-right fa fa-check"></span>
								</div>
								<div class="field">
									<span class="badge badge-orange">8</span> in-progress
									<span class="pull-right fa fa-adjust"></span>
								</div>
								<div class="field">
									<span class="badge badge-red">4</span> pending
									<span class="pull-right fa fa-list-ul"></span>
								</div>
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image">
								<img src="/assets/img/avatars/avatar2.jpg" alt="" />
							</span>
							<span class="title">
								Jane Doe
							</span>
							<div class="progress">
								<div class="progress-bar progress-bar-success" style="width: 65%">
									<span class="sr-only">35% Complete (success)</span>
								</div>
								<div class="progress-bar progress-bar-warning" style="width: 10%">
									<span class="sr-only">20% Complete (warning)</span>
								</div>
								<div class="progress-bar progress-bar-danger" style="width: 15%">
									<span class="sr-only">10% Complete (danger)</span>
								</div>
							</div>
							<span class="status">
								<div class="field">
									<span class="badge badge-green">10</span> completed
									<span class="pull-right fa fa-check"></span>
								</div>
								<div class="field">
									<span class="badge badge-orange">3</span> in-progress
									<span class="pull-right fa fa-adjust"></span>
								</div>
								<div class="field">
									<span class="badge badge-red">4</span> pending
									<span class="pull-right fa fa-list-ul"></span>
								</div>
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image">
								<img src="/assets/img/avatars/avatar4.jpg" alt="" />
							</span>
							<span class="title">
								Ellie Doe
							</span>
							<div class="progress">
								<div class="progress-bar progress-bar-success" style="width: 5%">
									<span class="sr-only">35% Complete (success)</span>
								</div>
								<div class="progress-bar progress-bar-warning" style="width: 48%">
									<span class="sr-only">20% Complete (warning)</span>
								</div>
								<div class="progress-bar progress-bar-danger" style="width: 27%">
									<span class="sr-only">10% Complete (danger)</span>
								</div>
							</div>
							<span class="status">
								<div class="field">
									<span class="badge badge-green">1</span> completed
									<span class="pull-right fa fa-check"></span>
								</div>
								<div class="field">
									<span class="badge badge-orange">6</span> in-progress
									<span class="pull-right fa fa-adjust"></span>
								</div>
								<div class="field">
									<span class="badge badge-red">2</span> pending
									<span class="pull-right fa fa-list-ul"></span>
								</div>
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image">
								<img src="/assets/img/avatars/avatar5.jpg" alt="" />
							</span>
							<span class="title">
								Lisa Doe
							</span>
							<div class="progress">
								<div class="progress-bar progress-bar-success" style="width: 21%">
									<span class="sr-only">35% Complete (success)</span>
								</div>
								<div class="progress-bar progress-bar-warning" style="width: 20%">
									<span class="sr-only">20% Complete (warning)</span>
								</div>
								<div class="progress-bar progress-bar-danger" style="width: 40%">
									<span class="sr-only">10% Complete (danger)</span>
								</div>
							</div>
							<span class="status">
								<div class="field">
									<span class="badge badge-green">4</span> completed
									<span class="pull-right fa fa-check"></span>
								</div>
								<div class="field">
									<span class="badge badge-orange">5</span> in-progress
									<span class="pull-right fa fa-adjust"></span>
								</div>
								<div class="field">
									<span class="badge badge-red">9</span> pending
									<span class="pull-right fa fa-list-ul"></span>
								</div>
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image">
								<img src="/assets/img/avatars/avatar6.jpg" alt="" />
							</span>
							<span class="title">
								Kelly Doe
							</span>
							<div class="progress">
								<div class="progress-bar progress-bar-success" style="width: 45%">
									<span class="sr-only">35% Complete (success)</span>
								</div>
								<div class="progress-bar progress-bar-warning" style="width: 21%">
									<span class="sr-only">20% Complete (warning)</span>
								</div>
								<div class="progress-bar progress-bar-danger" style="width: 10%">
									<span class="sr-only">10% Complete (danger)</span>
								</div>
							</div>
							<span class="status">
								<div class="field">
									<span class="badge badge-green">6</span> completed
									<span class="pull-right fa fa-check"></span>
								</div>
								<div class="field">
									<span class="badge badge-orange">3</span> in-progress
									<span class="pull-right fa fa-adjust"></span>
								</div>
								<div class="field">
									<span class="badge badge-red">1</span> pending
									<span class="pull-right fa fa-list-ul"></span>
								</div>
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image">
								<img src="/assets/img/avatars/avatar7.jpg" alt="" />
							</span>
							<span class="title">
								Jessy Doe
							</span>
							<div class="progress">
								<div class="progress-bar progress-bar-success" style="width: 7%">
									<span class="sr-only">35% Complete (success)</span>
								</div>
								<div class="progress-bar progress-bar-warning" style="width: 30%">
									<span class="sr-only">20% Complete (warning)</span>
								</div>
								<div class="progress-bar progress-bar-danger" style="width: 10%">
									<span class="sr-only">10% Complete (danger)</span>
								</div>
							</div>
							<span class="status">
								<div class="field">
									<span class="badge badge-green">1</span> completed
									<span class="pull-right fa fa-check"></span>
								</div>
								<div class="field">
									<span class="badge badge-orange">6</span> in-progress
									<span class="pull-right fa fa-adjust"></span>
								</div>
								<div class="field">
									<span class="badge badge-red">2</span> pending
									<span class="pull-right fa fa-list-ul"></span>
								</div>
							</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image">
								<img src="/assets/img/avatars/avatar8.jpg" alt="" />
							</span>
							<span class="title">
								Debby Doe
							</span>
							<div class="progress">
								<div class="progress-bar progress-bar-success" style="width: 70%">
									<span class="sr-only">35% Complete (success)</span>
								</div>
								<div class="progress-bar progress-bar-warning" style="width: 20%">
									<span class="sr-only">20% Complete (warning)</span>
								</div>
								<div class="progress-bar progress-bar-danger" style="width: 5%">
									<span class="sr-only">10% Complete (danger)</span>
								</div>
							</div>
							<span class="status">
								<div class="field">
									<span class="badge badge-green">13</span> completed
									<span class="pull-right fa fa-check"></span>
								</div>
								<div class="field">
									<span class="badge badge-orange">7</span> in-progress
									<span class="pull-right fa fa-adjust"></span>
								</div>
								<div class="field">
									<span class="badge badge-red">1</span> pending
									<span class="pull-right fa fa-list-ul"></span>
								</div>
							</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- /TEAM STATUS -->
	</header>
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
										<h4><i class="fa fa-table"></i>Users</h4>
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
										<form role="form" method="POST" action="/dashboard/updateuser" enctype="multipart/form-data">
										<input type="hidden" class="form-control" value="<?=$user->id?>" name="user_id" required id="exampleInputEmail1" placeholder="User Name">
											<div class="form-group">
												<label for="exampleInputEmail1">User Name</label>
												<input type="text" class="form-control" value="<?=$user->name?>" name="name" required id="exampleInputEmail1" placeholder="User Name">
											</div>

											<div class="form-group">
												<label for="exampleInputPassword1">Email</label>
												<input type="email" class="form-control" value="<?=$user->email?>" name="email" required id="exampleInputPassword1" placeholder="Emial">
											</div>
											<div class="form-group">
												<label for="exampleInputPassword1">Phone</label>
												<input type="text" class="form-control" value="<?=$user->phone?>" name="phone" required id="exampleInputPassword1" placeholder="Phone">
											</div>
											<div class="form-group">
												<label for="exampleInputPassword1">Password</label>
												<input type="password" class="form-control" name="password"  id="exampleInputPassword1" placeholder="password">
											</div>
											<div class="form-group">
												<label for="exampleInputPassword1">Password Confirmation</label>
												<input type="password" class="form-control" name="password_confirmation"  id="exampleInputPassword1" placeholder="password confirmation">
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