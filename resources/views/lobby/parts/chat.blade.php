



<style id="dynamic-styles"></style>
<div id="hangout" style="z-index: 9999;">
    <div id="head" class="style-bg">  <i class="mdi mdi-fullscreen"></i> <i class="mdi mdi-menu"></i>
        <h1>John Doe</h1><i class="mdi mdi-chevron-down"></i></div>
    <div id="content">
        <div class="overlay"></div>

        <div id="floater-position">
            <div id="add-contact-floater" class="floater control style-bg hidden"><i class="mdi mdi-plus"></i></div>
            <div id="chat-floater" class="floater control style-bg hidden"><i class="mdi mdi-comment-text-outline"></i></div>
        </div>


        <div class="card menu">
            <div class="header">
                <img src="http://s8.postimg.org/76bg2es2t/index.png" />
                <h3></h3>
            </div>
            <div class="content">

                <div class="i-group">
                    <input type="text" id="username"><span class="bar"></span>
                    <label>Name</label>
                </div>
                <br />
                <div class="center"><canvas id="colorpick" width="250" height="220" ></canvas></div>
            </div>
        </div>

        <div class="list-text">
            <ul class="list mat-ripple">
                <li><img src="http://lorempixel.com/100/100/people/1/">
                    <div class="content-container">
                        <span class="name">Angie</span>
                        <span class="txt">i get the other involved a bit </span>
                    </div>
                    <span class="time">
          14:00
        </span>
                </li>

                <li><img src="http://lorempixel.com/100/100/people/4/">
                    <div class="content-container">
                        <span class="name">Larissa</span>
                        <span class="txt">Hi! how are you :] </span>
                    </div>
                    <span class="time">
          16:02
        </span>
                </li>

                <li><img src="http://lorempixel.com/100/100/people/">
                    <div class="content-container">
                        <span class="name">Peter</span>
                        <span class="txt">Want to go drink a beer after work ?</span>
                    </div>
                    <span class="time">
          16:03
        </span>
                </li>
            </ul>
        </div>
        <div class="list-phone">
            <div class="meta-bar"><input class="nostyle search-filter" type="text" placeholder="Name, phone number" /></div>
            <ul class="list mat-ripple">
                <li><img src="http://lorempixel.com/100/100/people/1/">
                    <div class="content-container">
                        <span class="name">Angie</span>
                        <span class="phone">000-555-28175</span>
                        <span class="meta">Mobile</span>
                    </div>
                    <span class="time">
          2015-01-01 03:35
        </span>
                </li>
                <li><img src="http://lorempixel.com/100/100/people/3/">
                    <div class="content-container">
                        <span class="name">Bert</span>
                        <span class="phone">666-222-11433</span>
                        <span class="meta">Main</span>
                    </div>
                    <span class="time">
          2015-01-01 03:35
        </span>
                </li>
            </ul>
        </div>
        <div class="list-chat">
            <chat-messages :messages="messages"></chat-messages>

            <chat-form
                    v-on:messagesent="addMessage"
                    :user="{{ Auth::user() }}"
            ></chat-form>

        </div>

    </div>

    <div id="contact-modal" data-mode="add" class="card dialog">
        <h3>Add Contact</h3>
        <div class="i-group">
            <input type="text" id="new-user"><span class="bar"></span>
            <label>Name</label>
        </div>

        <div class="btn-container">
            <span class="btn cancel">Cancel</span>
            <span class="btn save">Save</span>
        </div>

    </div>

</div>






