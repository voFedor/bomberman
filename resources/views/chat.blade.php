@extends('layouts.app')

@section('content')


   <div class="col-md-2">
       <ul class="list-group">
       @foreach($users as $chatuser)
           <li v-on:click="getUserId" class="list-group-item" id="{{ $chatuser->id }}" value="{{ $chatuser->name }}">{{ $chatuser->name }}</li>
       @endforeach
       </ul>
   </div>





<div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading" id="accordion">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                    <div class="btn-group pull-right">
                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                    </div>
                </div>
            <div class="panel-collapse collapse" id="collapseOne">
                <div class="panel-body">
                    <ul class="chat" id="chat">
                        <li class="left clearfix" v-for="chat in chats[chatWindow.senderid]" v-bind:message="chat.message" v-bind:username="chat.username"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">@{{chat.name}}</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                                    @{{chat.message}}
                                </p>
                            </div>
                        </li>
                        
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" 
:id="chatWindow.senderid" v-model="chatMessage[chatWindow.senderid]" v-on:keyup.enter="sendMessage2"
                        placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat" :id="chatWindow.senderid" class="btn btn-warning btn-md" v-on:click="sendMessage2">
                                Send</button>
                        </span>
                    </div>
                </div>
            </div>
            </div>
        </div>

@endsection