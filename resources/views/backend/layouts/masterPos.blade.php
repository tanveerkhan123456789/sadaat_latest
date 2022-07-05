<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Laravel Role Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.partials.styles')
    @yield('styles')
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->

        <!-- main content area start -->
        <div class="main-content">
            {{-- @include('backend.layouts.partials.headerPos') --}}
            @yield('admin-content')
        </div>
        <!-- main content area end -->
        {{-- @include('backend.layouts.partials.footer') --}}
    <!-- page container area end -->

    @include('backend.layouts.partials.offsets')
    @include('backend.layouts.partials.scripts')
    <script>
               @if(session('message'))
                toastr.success("{{ session('message') }}");
            @elseif(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
            $('.dropify').dropify();
        </script>
    @yield('scripts')
</body>

</html>
