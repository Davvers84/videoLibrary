<!doctype html>
<html>
<head>
    @include('includes.head')
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    @include('includes.nav')
</nav>

<header class="masthead text-center text-white">
<div class="masthead-content">
    <div class="container">
        <h1 class="masthead-heading mb-0">Error</h1>
        @if($successMessage)
            <h2 class="masthead-subheading mb-0">
                <div class="alert alert-success" role="alert">
                    {{ $successMessage }}
                </div>
            </h2>
        @endif
        @if($errorMessage)
            <h2 class="masthead-subheading mb-0">
                <div class="alert alert-danger" role="alert">
                    {{ $errorMessage }}
                </div>
            </h2>
        @endif

    </div>
</div>
</header>

<section>
    <div class="container">
        @yield('content')
    </div>
</section>

<!-- Footer -->
<footer class="py-5 bg-black">
    @include('includes.footer')
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>