<!DOCTYPE html>
<html lang="en">

<head>
    @section('title','AcaOnline')
    @include('includes.app-frontend.head')
</head>

<body>
	
	<div id="page">
	
	<!--inicio ->    header -->
    <header class="version_1">
    @include('includes.app-frontend.header')    
    </header>
	<!-- /header -->
	
	<!--inicio ->   /main-->
	@yield('content')
	<!--/main-->
	
	<!--inicio ->   footer-->
    @include('includes.app-frontend.footer')    
	<!--/footer-->

	</div>
	<!-- page -->
	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- COMMON SCRIPTS -->
    @include('includes.app-frontend.scripts')
</body>
</html>