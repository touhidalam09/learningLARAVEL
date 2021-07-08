<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.headerMetaData')

        <title>@yield('title','Dashboard')</title>

        @include('layouts.headerLink')

    </head>
    <body class="antialiased">
        <div class="wrapper ">
            <!--Sidebar STAR-->
            @include('layouts.sidebar')
            <!--Sidebar END-->
            <div class="main-panel">
                <!-- Navbar -->
                @include('layouts.navbar')
                <!-- End Navbar -->
                
                <!--Dynamic Body START-->
                <div class="content">
                    <div class="container-fluid">
                        <!-- your content here -->
                        @yield('dyBody')
                    </div>
                </div>
                <!--Dynamic Body END-->
                
                @include('layouts.footer')
                
            </div>
        </div>
        @include('layouts.script')
        @yield('custom-sricpt')
    </body>
</html>
