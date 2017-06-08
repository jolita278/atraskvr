<!doctype html>
<html lang="{{ config('app.locale') }}">

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
@yield('scripts')
</html>
