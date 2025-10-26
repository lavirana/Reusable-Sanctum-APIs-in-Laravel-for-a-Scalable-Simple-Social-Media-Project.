@extends('pages.layout')
@section('title', 'Messages')
@section('content')

<style>
	.message-inner-dt {
    padding: 3px;
}
/* Chat message wrapper */
.messages-line {
  display: flex;
  flex-direction: column;
  padding: 10px;
}

/* Each message block */
.msg {
  display: flex;
  margin-bottom: 10px;
  width: 100%;
}

/* Left (received) message */
.msg.left {
  justify-content: flex-start;
}

/* Right (sent) message */
.msg.right {
  justify-content: flex-end;
}

/* The bubble itself */
.message-inner-dt {
  max-width: 70%;
  padding: 10px 14px;
  border-radius: 18px;
  word-wrap: break-word;
  font-size: 14px;
  line-height: 1.4;
}

/* Receiver bubble */
.msg.left .message-inner-dt {
  background-color: #f1f0f0;
  color: #333;
  border-top-left-radius: 0;
}

/* Sender bubble */
.msg.right .message-inner-dt {
  background: linear-gradient(135deg, #43cea2, #185a9d);
  color: #fff;
  border-top-right-radius: 0;
}

</style>
<section class="messages-page">
  <div class="container">
    <div class="messages-sec row">
      
      <!-- USERS LIST -->
      <div class="col-lg-4 col-md-12 no-pdd">
        <div class="msgs-list">
          <div class="msg-title">
            <h3>Messages</h3>
          </div>
          <div class="messages-list">
            <ul id="userList">
              <!-- Will load dynamically -->
            </ul>
          </div>
        </div>
      </div>

      <!-- CHAT WINDOW -->
      <div class="col-lg-8 col-md-12 pd-right-none pd-left-none">
        <div class="main-conversation-box">
          <div class="message-bar-head">
            <div class="usr-msg-details">
              <div class="usr-ms-img">
                <img id="chatUserImg" src="https://via.placeholder.com/50" alt="">
              </div>
              <div class="usr-mg-info">
                <h3 id="chatUserName">Select a user</h3>
                <p id="chatUserStatus">Online</p>
              </div>
            </div>
          </div>

          <!-- CHAT MESSAGES -->
          <div class="messages-line" id="chatBox" style="height:350px; overflow-y:auto; margin-top:13%">
            <p class="text-center text-muted mt-3">Select a user to start chatting</p>
          </div>

          <!-- MESSAGE INPUT -->
          <div class="message-send-area">
            <form id="sendMessageForm">
			<input type="hidden" id="receiverId" value="">
              <div class="mf-field">
                <input type="text" id="messageInput" placeholder="Type a message here">
                <button type="submit" id="sendBtn" style="background: linear-gradient(135deg,#43cea2,#185a9d);">Send</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection
