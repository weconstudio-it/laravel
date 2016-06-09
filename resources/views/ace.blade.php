<!DOCTYPE html>
<html lang="it">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>@yield('title')</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ url('css/components-all.css') }}" />

		<!-- text fonts -->
		<link rel="stylesheet" href="{{ url('css/ace-fonts.min.css') }}" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{ url('css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{ url('css/ace-skins.min.css') }}" />
		<link rel="stylesheet" href="{{ url('css/ace-rtl.min.css') }}" />

		<!-- ace settings handler -->
		<script src="{{ url('js/ace-extra.min.js') }}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="{{ url('js/ie-lte8-all.js') }}"></script>
		<![endif]-->

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ url('css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
		<link rel="stylesheet" href="{{ url('css/ace-ie.min.css') }}" />
		<![endif]-->

		<?php if (app('env') == 'local'): ?>
		<!-- put your custom DEBUG css here -->
		<link rel="stylesheet" href="{{ url('css/app.css') }}" />
		<?php else: ?>
		<link rel="stylesheet" href="{{ url(elixir('css/app.css')) }}" />
		<?php endif; ?>
	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="{{ url('/#dashboard') }}" class="navbar-brand">
						<small>
							<i class="fa fa-bolt"></i>
							@yield ('application_title')
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						@include('ace/header_dropdown_1')

						@include('ace/header_dropdown_2')

						@include('ace/header_dropdown_3')

						<!-- #section:basics/navbar.user_menu -->
						@include('ace/header_dropdown_profile')
						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>

		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				@include ('ace/sidebar_shortcuts')
				@include ('ace/sidebar')
			</div>
			<!-- /section:basics/sidebar -->

			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						@include('ace/breadcrumbs')
						@include('ace/navsearch')
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<div id="page-content-section" data-ajax-section="true" data-ajax-url="{{ url('agent') }}">
							<!-- ajax content goes here -->
							@yield('content')
						</div><!-- /.page-content-area -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					@include ('ace/footer')
					<!-- /section:basics/footer -->
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{ url('js/components-all.js') }}"></script>
		<!-- <![endif]-->
		<!--[if IE]>
		<script src="{{ url('js/ie-all.js') }}"></script>
		<![endif]-->
		<script src="{{ url('js/it-all.js') }}"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../../components/_mod/jquery.mobile.custom/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>

		<!-- ace scripts -->
		<script src="{{ url('js/ace-elements.min.js') }}"></script>
		<script src="{{ url('js/ace.min.js') }}"></script>

		<?php if (app('env') == 'local'): ?>
		<script src="{{ url('js/custom-all.js') }}"></script>
		<?php else: ?>
		<script src="{{ url(elixir('js/custom-all.js')) }}"></script>
		<?php endif; ?>
		<script>
			$(function() {
				@if(\Auth::check())
					app.baseUrl = "{{ url('/') }}";
					app.init();
				@endif
			});
		</script>
	</body>
</html>