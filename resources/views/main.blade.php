<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>

    <link rel="stylesheet" href="/css/app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('head')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="/">Trade Visual</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="/">Home</a>
            <a class="nav-item nav-link" href="/interactive">Interactive</a>
            <a class="nav-item nav-link" href="/infographic">Infographic</a>
            <a class="nav-item nav-link" href="/map">Map</a>
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
