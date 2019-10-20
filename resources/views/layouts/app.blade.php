<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WaterApp</title>

	<!-- Core JS files -->
	<script type="text/javascript" src="/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	 

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->


   
	<!-- Theme JS files -->
	<script async defer src="http://maps.google.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&callback=initMap" type="text/javascript"></script>
	<script type="text/javascript" src="/assets/js/core/libraries/jquery_ui/widgets.min.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/pickers/location/typeahead_addresspicker.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/pickers/location/autocomplete_addresspicker.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/pickers/location/location.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/ui/prism.min.js"></script>

	<script type="text/javascript" src="/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="/assets/js/plugins/forms/selects/select2.min.js"></script>

	<script type="text/javascript" src="/assets/js/core/app.js"></script>
	<script type="text/javascript" src="/assets/js/pages/datatables_basic.js"></script>
	<script type="text/javascript" src="/assets/js/pages/picker_location.js"></script>
	<!-- /theme JS files -->
	<style>
      /* Set the size of the div element that contains the map */
      #detail-map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
</head>

<body class="navbar-top">

	<!-- Main navbar -->
	<div class="navbar navbar-default navbar-fixed-top header-highlight">
		<div class="navbar-header">
			<a class="navbar-brand" href="/">WaterApp</a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-fixed">
				<div class="sidebar-content">

					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Menu</span> <i class="icon-menu" title="Main pages"></i></li>
								<li {{{ (Request::is('/') ? 'class=active' : '') }}}><a href="/"><i class="icon-users"></i><span>Data Monitoring</span></a></li>
                                <li {{{ (Request::is('riwayat') ? 'class=active' : '') }}}><a href="/riwayat"><i class=" icon-history"></i> <span>Riwayat Klasifikasi</span></a></li>
								<li {{{ (Request::is('informasi') ? 'class=active' : '') }}}><a href="/informasi"><i class="icon-home4"></i> <span>Informasi</span></a></li>
								<!-- /main -->

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4>
								<span class="text-semibold">{{{ (Request::is('/') ? 'Data Monitoring' : '') }}}</span>
                                <span class="text-semibold">{{{ (Request::is('data-training') ? 'Data Training' : '') }}}</span>
                            </h4>
						</div>
                        @if (Session::has('message'))
                        <div class="alert bg-success alert-styled-left">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">{{ Session::get('message') }}</span>
                        </div>
                        @endif
					</div>
				</div>
				<!-- /page header -->

				<!-- Content area -->
				<div class="content">
                    @yield('content')

                    <!-- Footer -->
					<div class="footer text-muted">
						&copy; 2019. <a href="#">WaterApp</a> by <a href="https://facebook.com/nurfi.agnia" target="_blank">Nurfi Agnia</a>
					</div>
					<!-- /footer -->
                </div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
