@extends('pages.layout')

@section('title', 'Messages')

@section('content')
<style>
.message-inner-dt > p {
    background: linear-gradient(135deg, #43cea2, #185a9d);
    color: #fff;
    padding: 10px 14px;
    border-radius: 10px;
    display: inline-block;
}
.message-dt.st3 .message-inner-dt > p {
    background: #f3f3f3;
    color: #333;
}
.messages-line {
    height: 450px;
    overflow-y: auto;
    padding: 15px;
}
.msg.left { text-align: left; }
.msg.right { text-align: right; }
</style>

<section class="messages-page">
    <div class="container">
        <div class="messages-sec">
            <div class="row">
                <!-- Left user list -->
                <div class="col-lg-4 col-md-12 no-pdd">
                    <div class="msgs-list">
                        <div class="msg-title">
                            <h3>Messages</h3>
                        </div>
                        <div class="messages-list">
                            <ul id="usersList">
                                <!-- Example user -->
                                <li onclick="openChat(2)">
                                    <div class="usr-msg-details">
                                        <div class="usr-ms-img">
                                            <img src="https://gambolthemes.net/workwise-new/images/resources/m-img1.png" alt="">
                                        </div>
                                        <div class="usr-mg-info">
                                            <h3>John Doe</h3>
                                            <p>Click to chat</p>
                                        </div>
                                    </div>
                                </li>
                                <!-- You can loop all users here -->
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Right chat area -->
                <div class="col-lg-8 col-md-12 pd-right-none pd-left-none">
                    <div class="main-conversation-box">
                        <div class="message-bar-head">
                            <div class="usr-msg-details">
                                <div class="usr-ms-img">
                                    <img src="https://gambolthemes.net/workwise-new/images/resources/m-img1.png" alt="">
                                </div>
                                <div class="usr-mg-info">
                                    <h3 id="chatUserName">Select a user</h3>
                                    <p>Online</p>
                                </div>
                            </div>
                        </div>

                        <div class="messages-line" id="chatBox">
                            <!-- Messages appear here -->
                        </div>

                        <div class="message-send-area">
                            <form id="sendMessageForm" onsubmit="return false;">
                                <input type="hidden" id="receiverId" value="">
                                <div class="mf-field">
                                    <input type="text" id="messageInput" placeholder="Type a message here">
                                    <button type="button" id="sendBtn" style="background: linear-gradient(135deg, #43cea2, #185a9d); color: white;">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
