<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <link href="/css/app.css" rel=stylesheet>

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
