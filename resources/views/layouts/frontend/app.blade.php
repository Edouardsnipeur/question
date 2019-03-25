<!DOCTYPE html>
<html class="fonts-loaded" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.frontend.partial.head')
<body class="theme-sky" data-theme-color="#f3f5f9">



<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<main class="main">
    @yield('content')
</main>
@include('layouts.frontend.partial.footer')
</body>
</html>