<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.head')
</head>
<body class="bg-light style-default style-rounded">
<!-- Preloader -->
  <div class="loader-mask">
    <div class="loader">
      <div></div>
    </div>
  </div>
  <div class="content-overlay"></div>
  <header class="sidenav" id="sidenav">
  	@include('partials.topHead')
  </header>
  <main class="main oh" id="main">
  	<!-- Top Bar -->
    <div class="top-bar d-none d-lg-block">
    	@include('partials.topBar')
    </div>
    <!-- Navigation -->
    <header class="nav">
    	@include('partials.header')
    </header>
    <div class="main-container container pt-24" id="main-container">
    	 @yield('content')
    </div>
    <footer class="footer footer--dark">
  		@include('partials.footer')
  	</footer>
  	<div id="back-to-top">
  		<a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
	</div>
  </main>
  <!-- jQuery Scripts -->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/easing.min.js')}}"></script>
  <script src="{{asset('js/owl-carousel.min.js')}}"></script>
  <script src="{{asset('js/flickity.pkgd.min.js')}}"></script>
  <script src="{{asset('js/twitterFetcher_min.js')}}"></script>
  <script src="{{asset('js/jquery.newsTicker.min.js')}}"></script>  
  <script src="{{asset('js/modernizr.min.js')}}"></script>
  <script src="{{asset('js/scripts.js')}}"></script>
</body>
</html>