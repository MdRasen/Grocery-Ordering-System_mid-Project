<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        @include('includes.navbar')
        <div>
            @yield('content')
        </div>
        {{-- @include('includes.products') --}}
    </body>
</html>