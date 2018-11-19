<div class="navbar-top">
    <!-- site brand	 -->
    <div class="site-brand">
        <a href="/" class="brand">
        <img src="/template/mobile/{{env('MOBILE_THEME')}}/img/logo.png"   width="134" height="40" alt="Logo" />

    </div>
    <!-- end site brand	 -->
    <div class="side-nav-panel-right">
        @if(Auth::user())
            <z href="#" data-activates="slide-out-right" class="side-nav-left"><i class="fa fa-user"></i>профиль</z>
        @else
            <z onclick="return openAuthModal()" href="#" class="side-nav-left"><i class="fa fa-user"></i>Вход</z>
        @endif
       <p></p>
    </div>
</div>
