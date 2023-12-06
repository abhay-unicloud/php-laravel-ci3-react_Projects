<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @stack('css')
</head>
<body>
    <header>
       @include('layouts.header')
    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer>
    @include('layouts.footer')
    </footer>
    @stack('script')
</body>
</html>