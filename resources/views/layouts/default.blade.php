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