@extends('mobile.layouts.app')

@section('content')

    <!-- login -->

    <div class="pages section">
        <div class="container">
            <div class="blog-single">
                <img src="/template/mobile/{{env('MOBILE_THEME')}}/img/{{$game->getLogo()}}" alt="">
                <div class="blog-single-content">
                    <h5>{{$game->ru_name}}</h5>

                    <p>{{$game->description}}</p>
                    <div class="">
                        <h5> Игроков онлайн: 0 </h5>
                        @if(Auth::user())
                            <div class="post" style="text-align: center">
                                <ul id="generate_ui">
                                    <button id="generate_btn" onclick='return generate_code("{{$game->slug}}")' style="padding-left: 5px;padding-right: 5px;" class="btn btn-sm btn-warning">Пригласить</button>
                                </ul>
                                <div id="social_btn" style="display: none">
                                    <script src="https://yastatic.net/share2/share.js" async="async"></script>
                                    <div class="ya-share2" data-services="vkontakte,twitter,facebook,gplus,linkedin,odnoklassniki,telegram" data-title="{{Auth::user()->first_name}} {{Auth::user()->last_name}} вызвал вас на дуэль" data-description="{{Auth::user()->first_name}} {{Auth::user()->last_name}} вызвал вас на дуэль"></div>
                                </div>
                            </div>
                            @else
                            <button id="generate_btn" onclick='return openModalAuth()' style="padding-left: 5px;padding-right: 5px;" class="btn btn-sm btn-warning">Пригласить</button>
                        @endif
                    </div>
                    <div class="share-post">
                        <ul>
                            {{--<button onclick="return invaiteFriend('{{$game->id}}')" style="padding-left: 5px;padding-right: 5px;" class="btn btn-sm btn-primary">Пригласить друга</button>--}}
                            <button onclick="return checkBalance('{{$game->id}}')" style="padding-left: 5px;padding-right: 5px;" class="btn btn-sm btn-info">Играть на 100р</button>
                        </ul>
                    </div>


                </div>


                </div>
            </div>
        </div>

    <!-- end login -->





@endsection
