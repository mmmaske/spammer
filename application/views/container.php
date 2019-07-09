<?php
$page['title']		=	isset($page['title']) ? $page['title'] : 'Spammer';
$page['subtitle']	=	isset($page['subtitle']) ? $page['subtitle'] : 'Email Spammer';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Batch Email Sender</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo SITEURL; ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo SITEURL; ?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo SITEURL; ?>/assets/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo SITEURL; ?>/assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo SITEURL; ?>/assets/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<a href="<?php echo SITEURL; ?>" class="logo">
			<span class="logo-mini">BES</span>
			<span class="logo-lg">Batch Email Sender</span>
		</a>
		<nav class="navbar navbar-static-top">
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="https://avatars.dicebear.com/v2/male/spammer.svg" class="user-image" alt="User Image">
							<span class="hidden-xs">Bes</span>
						</a>
						<ul class="dropdown-menu">
							<li class="user-header">
								<img src="https://avatars.dicebear.com/v2/male/spammer.svg" class="img-circle" alt="User Image">
								<p>
									Batch Email Sender
								</p>
							</li>
							<li class="user-footer">
								<div class="pull-right">
									<a href="#" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
			<?php echo $page['title']; ?>
			<small><?php echo $page['subtitle']; ?></small>
			</h1>
		</section>
		<section class="content row">
			<?php include($viewfile); ?>
		</section>
	</div>
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Version</b> 0.1
		</div>
	</footer>
	<div class="control-sidebar-bg"></div>
</div>
<script src="<?php echo SITEURL; ?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo SITEURL; ?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo SITEURL; ?>/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo SITEURL; ?>/assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo SITEURL; ?>/assets/dist/js/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo SITEURL; ?>/assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo SITEURL; ?>/assets/dist/js/demo.js"></script>
<script>
	$(document).ready(function () {
		$('.sidebar-menu').tree();
		<?php if(!empty($_SESSION['pss']['alert'])){
		echo "
			swal({
			title: '".$_SESSION['pss']['alert']['title']."',
			text: '".$_SESSION['pss']['alert']['text']."',
			icon: '".$_SESSION['pss']['alert']['icon']."'
			});
		";
		unset($_SESSION['pss']['alert']);
		} ?>
	})
</script>
</body>
</html>
