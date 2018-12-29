@extends('layouts.lobby')

@section('content')

    <!-- login -->

    <div class="pages section">
        <div class="container">
            <div class="blog-single">
                <img src="/template/mobile/{{env('MOBILE_THEME')}}/img/{{$game->getLogo()}}" alt="">
                <img src="" alt="">
                <div class="blog-single-content">
                    <h4 style="font-weight: bold">{{$game->ru_name}}</h4>
                    <h5>Регистрийруйся, приглашай друга на дуэль, побеждай и зарабатывай на своей победе прямо сейчас.<br/>Минимальная ставка 100 рублей.<br/>Побеждай и выводи выигрыш себе на карту в любой момент.</h5>

                    <p>{{$game->description}}</p>
                    <div class="share-post">
                        <ul>
                            <button onclick="return checkBalance('{{$game->id}}', 1)" style="padding-left: 5px;padding-right: 5px;" class="btn btn-sm btn-info">Играть просто так</button>
                            {{--<button onclick="return invaiteFriend('{{$game->id}}')" style="padding-left: 5px;padding-right: 5px;" class="btn btn-sm btn-primary">Пригласить друга</button>--}}

                            <button onclick="return checkBalance('{{$game->id}}', 5)" style="padding-left: 5px;padding-right: 5px;" class="btn btn-sm btn-info">Играть на 100р</button>
                        </ul>
                    </div>
                    <div class="">
                        <h5> Игроков онлайн: 10 </h5>
                        @if(Auth::user())
                            <div class="post" style="text-align: center">
                                <ul id="generate_ui">
                                    {{--<button id="generate_btn" onclick='return generate_code("{{$game->slug}}")' style="padding-left: 5px;padding-right: 5px;" class="btn btn-sm btn-warning">Пригласить</button>--}}
                                </ul>
                                <div id="social_btn" style="">
                                    <script src="https://yastatic.net/share2/share.js" async="async"></script>
                                    {{--<div class="ya-share2" data-services="vkontakte,twitter,facebook,gplus,linkedin,odnoklassniki,telegram" data-title="{{Auth::user()->first_name}} {{Auth::user()->last_name}} вызвал вас на дуэль" data-description="{{Auth::user()->first_name}} {{Auth::user()->last_name}} вызвал вас на дуэль"></div>--}}
                                    <p>Пригласить</p>
                                    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,viber,whatsapp,skype,telegram" data-title="{{Auth::user()->first_name}} хочет поспорить, кто из вас лучше"  data-description="{{Auth::user()->first_name}} хочет поспорить, кто из вас лучше" data-url="https://gamechainger.ru/game/22?ref={{Auth::user()->uuid}}&game={{$game->id}}&from=site_r&from=vk_fb" data-image="https://gamechainger.ru/template/mobile/cools/img/games/math.jpg">  </div>
                                </div>
                            </div>
                            @else
                            <button id="generate_btn" onclick='return openModalAuth()' style="padding-left: 5px;padding-right: 5px;" class="btn btn-sm btn-warning">Пригласить</button>
                        @endif
                    </div>



                </div>


                </div>
            </div>
        </div>

    <!-- end login -->





@endsection
