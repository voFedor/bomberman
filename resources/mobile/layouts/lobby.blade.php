<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('lobby.parts.meta')
    @include('lobby.parts.style')

</head>
<body>

<!-- loader -->
@include('lobby.parts.loader')
<!-- end loader -->

<!-- navbar top -->
@include('lobby.parts.navbar_top')
<!-- end navbar top -->

<!-- side nav right-->
@include('lobby.parts.site_navbar')
<!-- end side nav right-->

<!-- navbar bottom -->
@include('lobby.parts.bottom_navbar')
<!-- end navbar bottom -->

<!-- menu -->
@include('lobby.parts.menu')
<!-- end menu -->
@yield('content')


<!-- footer -->
@include('lobby.parts.footer')
<!-- end footer -->


@include('lobby.parts.modal')

<!-- scripts -->
@include('lobby.parts.javascripts')


</body>
</html>
