<?php
	session_start();
	if ($_SESSION) {
		header('Location: ../');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login Page - Ace Admin</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		
		<!-- text fonts -->
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300" />


		<link rel="stylesheet" href="../dist/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../dist/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../dist/css/fontdc.css" />
		<link rel="stylesheet" href="../dist/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="../dist/css/ace.min.css" />
		<link rel="stylesheet" href="../dist/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="../dist/css/animate.min.css" />
	

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="dist/css/ace-part2.min.css" />
		<![endif]-->	

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="dist/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="dist/js/html5shiv.min.js"></script>
		<script src="dist/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout blur-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-leaf green"></i>
									<span class="red">ISP</span>
									<span class="white" id="id-text2">Application</span>
								</h1>
								<h4 class="light-blue" id="id-company-text">&copy; CorePime</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Ingreso al Sistema
											</h4>
											<div class="space-6"></div>
											<form id="form_login" name="form_login">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" id="txt_1" name="txt_2" class="form-control" placeholder="Usuario" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Clave" id="txt_2" name="txt_2" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>
													<div class="space"></div>
													<div class="clearfix">										
														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary" id="btn_1">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>
													<div class="space-4"></div>
												</fieldset>
											</form>											
										</div><!-- /.widget-main -->										
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->							
							</div><!-- /.position-relative -->							
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="../dist/js/jquery.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../dist/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='dist/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../dist/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});									
			
		</script>
		<script src="../dist/js/jquery.validate.min.js"></script>
		<script src="../dist/js/jquery.gritter.min.js"></script>
		<script src="../dist/js/lockr.min.js"></script>
		<script src="login.js"></script>
	</body>
</html>
