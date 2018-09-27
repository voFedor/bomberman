@extends('layouts.lobby')

@section('content')



    <section class="content-wrap ">
        <div class=" youplay-banner-parallax youplay-banner youplay-banner-id-1 mid banner-top">

            <div class="info">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4 col-md-offset-4">
                                <form role="form" method="post" action="send-payment">
                                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                    <div class="form-group">
                                        <label for="email">Сумма:</label>
                                        <input type="text" class="form-control" name="price" id="price">
                                    </div>
                                    <button type="submit" class="btn btn-default">Оплатить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>

        <!-- Footer -->
    @include('lobby.parts.footer')
    <!-- /Footer -->

    </section>

@endsection