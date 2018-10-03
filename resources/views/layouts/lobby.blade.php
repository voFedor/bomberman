<!DOCTYPE html>
<html lang="en">
<head>
    @include('lobby.parts.head')
</head>
<body>

<!-- Preloader -->
{{--@include('lobby.parts.preloader')--}}
<!-- /Preloader -->

<!-- Navbar -->
@include('lobby.parts.navbar')
<!-- /Navbar -->


@yield('content')

{{--@include('lobby.parts.search')--}}

<!-- ScrollUp button start -->
@include('lobby.parts.scrollup')

@include('lobby.parts.javascript')


@include('lobby.parts.modal')


</body>
</html>