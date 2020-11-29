<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>

    <link rel="stylesheet" href="/css/app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('head')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="/">Trade Visual</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarfirst" aria-controls="navbarfirst" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarfirst">
            <ul class="navbar-nav">
            <a class="nav-item nav-link" href="/">Home</a>
            <a class="nav-item nav-link" href="/interactive">Interactive</a>
            <a class="nav-item nav-link" href="/infographic">Infographic</a>
            <a class="nav-item nav-link" href="/map">Map</a>
            <ul>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarfirst">
            <ul class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="/about">About</a>
                <a class="nav-item nav-link" href="/contact">Contact</a>
            </ul>
        </div>
    </nav>
    @yield('content')
    @yield('script')
</body>
    @yield('footer')
</html>
