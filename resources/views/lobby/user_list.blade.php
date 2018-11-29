@extends('layouts.lobby')

@section('content')
    <style>

        .people-list {
            /*width: 260px;*/
            float: left;
        }
        .people-list .search {
            padding: 20px;
        }
        .people-list input {
            border-radius: 3px;
            border: none;
            padding: 14px;
            color: white;
            background: #6A6C75;
            width: 90%;
            font-size: 14px;
        }
        .people-list .fa-search {
            position: relative;
            left: -25px;
        }
        .people-list ul {
            padding: 20px;
            height: 770px;

        }
        .people-list ul li {
            padding-bottom: 20px;
        }
        .people-list img {
            float: left;
        }
        .people-list .about {
            float: left;
            margin-top: 8px;
        }
        .people-list .about {
            padding-left: 8px;
        }
        .people-list .status {
            color: #92959E;
        }

        .chat {
            width: 640px;
            float: left;
            background: #F2F5F8;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            color: #434651;
        }
        .chat .chat-header {
            padding: 20px;
            border-bottom: 2px solid white;
        }
        .chat .chat-header img {
            float: left;
        }
        .chat .chat-header .chat-about {
            float: left;
            padding-left: 10px;
            margin-top: 6px;
        }
        .chat .chat-header .chat-with {
            font-weight: bold;
            font-size: 16px;
        }
        .chat .chat-header .chat-num-messages {
            color: #92959E;
        }
        .chat .chat-header .fa-star {
            float: right;
            color: #D8DADF;
            font-size: 20px;
            margin-top: 12px;
        }
        .chat .chat-history {
            padding: 30px 30px 20px;
            border-bottom: 2px solid white;
            overflow-y: scroll;
            height: 575px;
        }
        .chat .chat-history .message-data {
            margin-bottom: 15px;
        }
        .chat .chat-history .message-data-time {
            color: #a8aab1;
            padding-left: 6px;
        }
        .chat .chat-history .message {
            color: white;
            padding: 18px 20px;
            line-height: 26px;
            font-size: 16px;
            border-radius: 7px;
            margin-bottom: 30px;
            width: 90%;
            position: relative;
        }
        .chat .chat-history .message:after {
            bottom: 100%;
            left: 7%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #86BB71;
            border-width: 10px;
            margin-left: -10px;
        }
        .chat .chat-history .my-message {
            background: #86BB71;
        }
        .chat .chat-history .other-message {
            background: #94C2ED;
        }
        .chat .chat-history .other-message:after {
            border-bottom-color: #94C2ED;
            left: 93%;
        }
        .chat .chat-message {
            padding: 30px;
        }
        .chat .chat-message textarea {
            width: 100%;
            border: none;
            padding: 10px 20px;
            font: 14px/22px "Lato", Arial, sans-serif;
            margin-bottom: 10px;
            border-radius: 5px;
            resize: none;
        }
        .chat .chat-message .fa-file-o, .chat .chat-message .fa-file-image-o {
            font-size: 16px;
            color: gray;
            cursor: pointer;
        }
        .chat .chat-message button {
            float: right;
            color: #94C2ED;
            font-size: 16px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            font-weight: bold;
            background: #F2F5F8;
        }
        .chat .chat-message button:hover {
            color: #75b1e8;
        }

        .online, .offline, .me {
            margin-right: 3px;
            font-size: 10px;
        }

        .online {
            color: #86BB71;
        }

        .offline {
            color: #E38968;
        }

        .me {
            color: #94C2ED;
        }

        .align-left {
            text-align: left;
        }

        .align-right {
            text-align: right;
        }

        .float-right {
            float: right;
        }

        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }
    </style>
    <div class="section secondary-section" id="app">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Have You Seen our Works?</h1>
                <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
            </div>
            <div id="app">
                <chat-component :bet_id="{{$bet_id}}" :game_id="{{$game_id}}"></chat-component>
            </div>
            <!-- Start details for portfolio project 1 -->


        </div>
    </div>

@endsection