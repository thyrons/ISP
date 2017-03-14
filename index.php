<?php 
	session_start();
	if(!$_SESSION) {		
		header('Location: login/');
	}
	
?> 
<!DOCTYPE html>
<html ng-app="scotchApp" lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>ISP Application</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="dist/css/bootstrap.min.css" />
		<link rel="stylesheet" href="dist/css/font-awesome.min.css" />
		<link rel="stylesheet" href="dist/css/style.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="dist/css/animate.min.css" />
		<link rel="stylesheet" href="dist/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="dist/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="dist/css/chosen.min.css" />
		<link rel="stylesheet" href="dist/css/select2.min.css" />
		<link rel="stylesheet" href="dist/css/ui.jqgrid.min.css" />
		<link rel="stylesheet" href="dist/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="dist/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="dist/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="dist/css/bootstrap-datetimepicker-standalone.css" />
		<link rel="stylesheet" href="dist/css/bootstrap-editable.min.css" />
		<link rel="stylesheet" href="dist/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="dist/css/sweetalert.css" />



		<link rel="stylesheet" href="dist/css/jquery-ui.custom.min.css" />
		<link href="dist/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
		
		<!-- text fonts -->
		<link rel="stylesheet" href="dist/css/fontdc.css" />
		<!-- ace styles -->
		<link rel="stylesheet" href="dist/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<script src="dist/js/ace-extra.min.js"></script>		

		<!-- Angular js -->
		<script src="dist/angular-1.5.0/angular.js"></script>
		<script src="dist/angular-1.5.0/angular-route.js"></script>
		<script src="dist/angular-1.5.0/angular-animate.js"></script>
		<script src="dist/angular-1.5.0/ui-bootstrap-tpls-1.1.2.min.js"></script>		

		<!-- controlador procesos angular -->
  		<script src="data/app.js"></script>
  		<script src="data/home/app.js"></script>
  		<script src="data/user/app.js"></script>
  		<script src="data/cargo/app.js"></script>
  		<script src="data/clientes/app.js"></script>
  		<script src="data/planes/app.js"></script>
  		<script src="data/tiposPlan/app.js"></script>
  		<script src="data/interfaces/app.js"></script>

	</head>
	<body ng-controller="mainController" class="skin-3 no-skin" cz-shortcut-listen="true">
		<div id="navbar" class="navbar navbar-default" style="background: #2c6aa0;" >			
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left" >
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Ace Admin
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">						
						<li class="red">
							<a data-toggle="dropdown" class="dropdown-toggle" href="">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									8 Notifications
								</li>

								<li class="dropdown-content ace-scroll" style="position: relative;"><div class="scroll-track" style="display: none;"><div class="scroll-bar"></div></div><div class="scroll-content" style="max-height: 200px;">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
														New Comments
													</span>
													<span class="pull-right badge badge-info">+12</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<i class="btn btn-xs btn-primary fa fa-user"></i>
												Bob just signed up as an editor ...
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
														New Orders
													</span>
													<span class="pull-right badge badge-success">+8</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
														Followers
													</span>
													<span class="pull-right badge badge-info">+11</span>
												</div>
											</a>
										</li>
									</ul>
								</div></li>

								<li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>						
						<li class="light-blue">
							<a data-toggle="dropdown" href="" class="dropdown-toggle">
							<?php							
								echo '<img class="nav-user-photo" src="data/user/images/'.$_SESSION['userISP']['imagen'].'" alt="User Avatar">';
							?>
								
								<span class="user-info">
									<small>Bienvenido,</small>
									<?php  print_r($_SESSION['userISP']['usuario']); ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Configuraciones
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Perfil
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="login/exit.php">
										<i class="ace-icon fa fa-power-off"></i>
										Salir
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

		<div id="sidebar" class="sidebar responsive" data-sidebar="true" data-sidebar-scroll="true" data-sidebar-hover="true">

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-primary btn-white">
							<i class="ace-icon fa fa-signal red"></i>
						</button>

						<button class="btn btn-primary btn-white">
							<i class="ace-icon fa fa-pencil blue"></i>
						</button>

						<button class="btn btn-primary btn-white">
							<i class="ace-icon fa fa-users green"></i>
						</button>

						<button class="btn btn-primary btn-white">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-primary btn-white"></span>

						<span class="btn btn-primary btn-white"></span>

						<span class="btn btn-primary btn-white"></span>

						<span class="btn btn-primary btn-white"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

			<ul class="nav nav-list">
					<li ng-class="{active: $route.current.activetab == 'inicio'}" >
						<a href="#/">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li ng-class = "{'active open': $route.current.activetab == 'user' || $route.current.activetab == 'cargos' || $route.current.activetab == 'privilegios'}" >
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>
							Usuarios
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li ng-class="{active: $route.current.activetab == 'user'}">
								<a href="#/user" target="">
									<i class="menu-icon fa fa-caret-right"></i>
									Nuevo Usuario
								</a>
								<b class="arrow"></b>
							</li>												

							<li ng-class="{active: $route.current.activetab == 'cargo'}">
								<a href="#/cargo">
									<i class="menu-icon fa fa-caret-right"></i>
									Cargos
								</a>
								<b class="arrow"></b>
							</li>

							<li ng-class="{active: $route.current.activetab == 'privilegios'}">
								<a href="#/privilegios">
									<i class="menu-icon fa fa-caret-right"></i>
									Privilegios
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>	

					<li ng-class = "{'active open': $route.current.activetab == 'clientes' || $route.current.activetab == 'planes' || $route.current.activetab == 'tiposPlan'  }" >
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>
							Clientes & Planes
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li ng-class="{active: $route.current.activetab == 'clientes'}">
								<a href="#/clientes" target="">
									<i class="menu-icon fa fa-caret-right"></i>
									Nuevo Cliente
								</a>
								<b class="arrow"></b>
							</li>	
							<li ng-class="{active: $route.current.activetab == 'planes'}">
								<a href="#/planes" target="">
									<i class="menu-icon fa fa-caret-right"></i>
									Planes
								</a>
								<b class="arrow"></b>
							</li>	
							<li ng-class="{active: $route.current.activetab == 'tiposPlan'}">
								<a href="#/tiposPlan" target="">
									<i class="menu-icon fa fa-caret-right"></i>
									Tipos de Planes
								</a>
								<b class="arrow"></b>
							</li>	
						</ul>
					</li>		

					<li ng-class = "{'active open': $route.current.activetab == 'interfaces'}" >
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-empire"></i>
							Panel de control
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">																	
							<li ng-class="{active: $route.current.activetab == 'interfaces'}">
								<a href="#/interfaces">
									<i class="menu-icon fa fa-caret-right"></i>
									Interfaces
								</a>
								<b class="arrow"></b>
							</li>							
						</ul>
					</li>			
				</ul><!-- /.nav-list -->							

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<div class="main-content ng-view" id="main-container"></div>

				<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">ISP</span>
							Application © 2016-2017
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div>

		<script type="text/javascript">
			window.jQuery || document.write("<script src='dist/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='dist/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		
		<script src="dist/js/jquery-ui.min.js"></script>
		<script src="dist/js/fileinput.js" type="text/javascript"></script>
		<script src="dist/js/bootstrap.min.js"></script>
		<script src="dist/js/jquery.form.js"></script>
		<script src="dist/js/chosen.jquery.min.js"></script>
		
		<script src="dist/js/jquery.validate.min.js"></script>
		<script src="dist/js/jquery.ui.touch-punch.min.js"></script>
		<script src="dist/js/jquery.gritter.min.js"></script>
		<script src="dist/js/bootbox.min.js"></script>
		<script src="dist/js/jquery.easypiechart.min.js"></script>
		<script src="dist/js/fuelux/fuelux.wizard.min.js"></script>
		<script src="dist/js/additional-methods.min.js"></script>

		<script src="dist/js/jquery.hotkeys.min.js"></script>
		<script src="dist/js/bootstrap-wysiwyg.min.js"></script>
		<script src="dist/js/select2.min.js"></script>
		<script src="dist/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="dist/js/fuelux/fuelux.tree.min.js"></script>
		<script src="dist/js/x-editable/bootstrap-editable.min.js"></script>
		<script src="dist/js/x-editable/ace-editable.min.js"></script>
		<script src="dist/js/jquery.maskedinput.min.js"></script>
		<script src="dist/js/bootbox.min.js"></script>
		<script src="dist/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="dist/js/date-time/bootstrap-timepicker.min.js"></script>
		<script src="dist/js/date-time/moment.min.js"></script>
		<script src="dist/js/date-time/daterangepicker.min.js"></script>
		<script src="dist/js/date-time/bootstrap-datetimepicker.min.js"></script>
		
		<!-- script de las tablas -->
		<script src="dist/js/jqGrid/jquery.jqGrid.min.js"></script>
		<script src="dist/js/jqGrid/i18n/grid.locale-en.js"></script>
		<script src="dist/js/dataTables/jquery.dataTables.min.js"></script>
		<script src="dist/js/dataTables/jquery.dataTables.bootstrap.min.js"></script>
		<script src="dist/js/dataTables/dataTables.tableTools.min.js"></script>
		<script src="dist/js/dataTables/dataTables.colVis.min.js"></script>

		<!-- ace scripts -->
		<script src="dist/js/ace-elements.min.js"></script>
		<script src="dist/js/ace.min.js"></script>
		<script src="dist/js/lockr.min.js"></script>
		<script src="dist/js/sweetalert.min.js"></script>

		<script src="dist/js/highcharts/highcharts.js"></script>
		<script src="dist/js/highcharts/highcharts-3d.js"></script>
		<script src="dist/js/highcharts/modules/exporting.js"></script>

		

	</body>

	<style type="text/css">
  		#cuadro_estadistico .tickLabel{
     		max-width: 60px !important;
  		}		
  		.panel-body:not(.six-col) { padding:0px }
		.glyphicon { margin-right:3px; }
		.glyphicon-new-window { margin-left:3px; }
		.panel-body .radio,.panel-body .checkbox {margin-top: 0px;margin-bottom: 0px;}
		.panel-body .list-group {margin-bottom: 0;}
		.margin-bottom-none { margin-bottom: 0; }
		.panel-body .radio label,.panel-body .checkbox label { display:block; }
		.well-sm {padding: 6px !important}
		.well {margin-bottom: 5px !important; border-radius: 3px}
  	</style>
</html>