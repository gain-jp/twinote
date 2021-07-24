<head>
    <meta charset="UTF-8">
    <title>@yield('title')｜Twinote</title>
    <meta name="description" itemprop="description" content="@yield('description')">
    <meta name="keywords" itemprop="keywords" content="@yield('keywords')">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
</head>
<body>
    <div class="container">
        @yield('header')
        
        <div class="contents">
            <div class="main">
                @yield('content')
            </div>
        </div>
        
        @yield('footer')
    </div>
    
</body>