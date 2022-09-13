<!DOCTYPE html>
<html lang="en">
<head>
    <title>Plantilla - @yield('title')</title>
    @include('layouts._header')
    @yield('head')
    @include('layouts._scripts_primary')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('layouts._sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts._topbar')
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="small mb-0 text-gray-800">@yield('page-title')</h1>
                    </div>
                    @yield('content')
                </div>
            </div>
            @include('layouts._footer')
        </div>
    </div>
    @include('layouts._scripts_primary')
    @include('layouts._scripts')

    @yield('scripts')
</body>

</html>
