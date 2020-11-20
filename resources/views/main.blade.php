<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>

    <link rel="stylesheet" href="/css/app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    @yield('head')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="navbar-brand">Trade Visual</div>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="/">Home</a>
            <a class="nav-item nav-link" href="/about">About</a>
            <a class="nav-item nav-link" href="/contact">Contact</a>
            </div>
        </div>
    </nav>
    @yield('content')
    @yield('script')
</body>
    @yield('footer')
</html>
