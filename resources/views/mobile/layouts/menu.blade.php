<div class="menus" id="animatedModal2">
    <div class="close-animatedModal2 close-icon">
        <i class="fa fa-close"></i>
    </div>
    <div class="modal-content">
        <div class="container">
            <div class="row">
                {{--<div class="col s4">--}}
                    {{--<a href="index.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-home"></i>--}}
                            {{--</div>--}}
                            {{--Home--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="col s4">--}}
                    {{--<a href="shop.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-shopping-bag"></i>--}}
                            {{--</div>--}}
                            {{--Shop--}}
                        {{--</div>--}}
                    {{--</a>--}}
                    {{--@yield('content')--}}
                {{--</div>--}}
                {{--<div class="col s4">--}}
                    {{--<a href="shop-single.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-eye"></i>--}}
                            {{--</div>--}}
                            {{--Single Shop--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col s4">--}}
                    {{--<a href="wishlist.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-heart"></i>--}}
                            {{--</div>--}}
                            {{--Wishlist--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="col s4">--}}
                    {{--<a href="cart.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-shopping-cart"></i>--}}
                            {{--</div>--}}
                            {{--Cart--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="col s4">--}}
                    {{--<a href="checkout.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-credit-card"></i>--}}
                            {{--</div>--}}
                            {{--Checkout--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col s4">--}}
                    {{--<a href="blog.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-bold"></i>--}}
                            {{--</div>--}}
                            {{--Blog--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="col s4">--}}
                    {{--<a href="blog-single.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-file-text-o"></i>--}}
                            {{--</div>--}}
                            {{--Blog Single--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="col s4">--}}
                    {{--<a href="error404.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-hourglass-half"></i>--}}
                            {{--</div>--}}
                            {{--404--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col s4">--}}
                    {{--<a href="testimonial.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-support"></i>--}}
                            {{--</div>--}}
                            {{--Testimonial--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="col s4">--}}
                    {{--<a href="about-us.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-user"></i>--}}
                            {{--</div>--}}
                            {{--About Us--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="col s4">--}}
                    {{--<a href="contact.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-envelope-o"></i>--}}
                            {{--</div>--}}
                            {{--Contact--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col s4">--}}
                    {{--<a href="setting.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-cog"></i>--}}
                            {{--</div>--}}
                            {{--Settings--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="col s4">--}}
                    {{--<a href="login.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-sign-in"></i>--}}
                            {{--</div>--}}
                            {{--Login--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                @foreach($games as $game)
                    <div class="col s4">
                        <a href="/game/{{$game->slug}}">
                            <img class="game_image_all" src="/template/mobile/{{env('MOBILE_THEME')}}/img{{ $game->getLogo() }}" width="99px">
                        </a>
                    </div>
                @endforeach
                {{--<div class="col s4">--}}
                    {{--<a href="register.html" class="button-link">--}}
                        {{--<div class="menu-link">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="fa fa-user-plus"></i>--}}
                            {{--</div>--}}
                            {{--Register--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>
