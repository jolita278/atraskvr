<!doctype html>
<html lang="{{ config('app.locale') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    @include('admin.adminCSS')

</head>
<body>

<aside>
    @include('admin.adminSideBar')
</aside>
<main>
    @yield('adminList')
</main>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@yield('scripts')

</html>
