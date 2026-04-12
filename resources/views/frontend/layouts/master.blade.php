<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<!-- Meta Data -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title', config('app.name', 'Sky Tech Solve'))</title>

	{!! $seotags ?? '' !!}
	{!! $breadcrumbs ?? '' !!}
	{!! $jsonld ?? '' !!}

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset($settings->favicon ?? 'images/logo.png') }}" type="image/x-icon">

	<!-- Stylesheets -->
	<link href="{{asset('frontend')}}/css/bootstrap.css" rel="stylesheet">
	<link href="{{asset('frontend')}}/css/style.css" rel="stylesheet">
	<link href="{{asset('frontend')}}/css/responsive.css" rel="stylesheet">
	<!--Color Switcher Mockup-->
	<link href="{{asset('frontend')}}/css/color-switcher-design.css" rel="stylesheet">
	<!--Color Themes-->
	<link id="theme-color-file" href="{{asset('frontend')}}/css/color-themes/default-theme.css" rel="stylesheet">

	@stack('css')
	<!-- =======================================================
    * Template Name: Sky Tech Solve
    * Updated: Sep 10 2025 with Bootstrap v5.2.3
    * Template URL: https://skytechsolve.com
    * Author: Motiur Rahman (01909302126)
    * License: https://skytechsolve.com/license/
    ======================================================== -->
</head>

<body>

	<div class="page-wrapper">
		@if($settings->is_loading)
			<!-- Preloader -->
			<div class="preloader"></div>
		@endif

		@include('frontend.partials.header')

		{{ $slot }}

		<!-- Footer -->
		@include('frontend.partials.footer')
		@include('frontend.partials.social-button')

	</div>

	<!-- Color Palate / Color Switcher -->
	<div class="color-palate">
		<div class="color-trigger">
			<i class="fa fa-cog"></i>
		</div>
		<div class="color-palate-head">
			<h6>Choose Your Color</h6>
		</div>
		<div class="various-color clearfix">
			<div class="colors-list">
				<span class="palate default-color active"
					data-theme-file="{{asset('frontend')}}/css/color-themes/default-theme.css"></span>
				<span class="palate green-color"
					data-theme-file="{{asset('frontend')}}/css/color-themes/green-theme.css"></span>
				<span class="palate blue-color"
					data-theme-file="{{asset('frontend')}}/css/color-themes/blue-theme.css"></span>
				<span class="palate orange-color"
					data-theme-file="{{asset('frontend')}}/css/color-themes/orange-theme.css"></span>
				<span class="palate purple-color"
					data-theme-file="{{asset('frontend')}}/css/color-themes/purple-theme.css"></span>
				<span class="palate teal-color"
					data-theme-file="{{asset('frontend')}}/css/color-themes/teal-theme.css"></span>
				<span class="palate brown-color"
					data-theme-file="{{asset('frontend')}}/css/color-themes/brown-theme.css"></span>
				<span class="palate redd-color"
					data-theme-file="{{asset('frontend')}}/css/color-themes/redd-color.css"></span>
			</div>
		</div>
		<ul class="box-version option-box">
			<li>Full width</li>
			<li class="box">Boxed</li>
		</ul>
		<ul class="rtl-version option-box">
			<li>LTR Version</li>
			<li class="rtl">RTL Version</li>
		</ul>
		<div class="palate-foo">
			<span>You will find much more options for colors and styling in admin panel. This color picker is used only
				for demonstation purposes.</span>
		</div>
		<a href="#" class="purchase-btn">Purchase now $17</a>
	</div><!-- End Color Switcher -->

	<!--Scroll to top-->
	<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-circle-o-up"></span></div>

	<script src="{{asset('frontend')}}/js/jquery.js"></script>
	<script src="{{asset('frontend')}}/js/popper.min.js"></script>
	<script src="{{asset('frontend')}}/js/bootstrap.min.js"></script>
	<script src="{{asset('frontend')}}/js/jquery.fancybox.js"></script>
	<script src="{{asset('frontend')}}/js/owl.js"></script>
	<script src="{{asset('frontend')}}/js/wow.js"></script>
	<script src="{{asset('frontend')}}/js/appear.js"></script>
	<script src="{{asset('frontend')}}/js/mixitup.js"></script>
	<script src="{{asset('frontend')}}/js/script.js"></script>
	<!-- Color Setting -->
	<script src="{{asset('frontend')}}/js/color-settings.js"></script>

	@stack('js')
</body>

</html>