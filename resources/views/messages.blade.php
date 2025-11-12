@extends('pages.layout')
@section('title', 'Messages')
@section('content')

<style>
/* --- Styles for Chat UI --- */
  .message-inner-dt {
    padding: 3px;
}

.msg {
  display: flex;
  width: 100%;
  margin: 6px 0;
}

.msg.left {
  justify-content: flex-start;
}

.msg.right {
  justify-content: flex-end;
}

.message-inner-dt {
  padding: 10px 14px;
  border-radius: 18px;
  max-width: 70%;
  word-wrap: break-word;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1); /* Added shadow for depth */
}

.msg.left .message-inner-dt {
  background: #f1f0f0;
  color: #333;
  border-top-left-radius: 4px; /* Slightly adjusted to look better */
}

.msg.right .message-inner-dt {
  background: linear-gradient(135deg, #43cea2, #185a9d);
  color: #fff;
  border-top-right-radius: 4px; /* Slightly adjusted to look better */
}

/* Sidebar styling for user items */
.messages-list ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.user-item {
    padding: 10px;
    border-bottom: 1px solid #eee;
    transition: background-color 0.2s;
}
.user-item:hover, .user-item.active {
    background-color: #f5f5f5;
}
.usr-msg-details {
    display: flex;
    align-items: center;
}
.usr-ms-img img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}
.usr-mg-info h3 {
    font-size: 16px;
    margin: 0;
    font-weight: 600;
}
.usr-mg-info p {
    font-size: 12px;
    color: #888;
    margin: 0;
}

/* Chat box height and scroll fix */
.messages-line {
    padding: 20px;
    margin-top: 0 !important;
}
.main-conversation-box {
    display: flex;
    flex-direction: column;
    height: 60vh; /* Adjust height for better fit */
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
}
.messages-line {
    flex-grow: 1;
    overflow-y: auto;
    padding: 15px;
}
.message-bar-head {
    border-bottom: 1px solid #eee;
    padding: 15px;
    background-color: #f7f7f7;
}
.message-send-area {
    padding: 15px;
    border-top: 1px solid #eee;
}
.mf-field {
    display: flex;
}
.mf-field input[type="text"] {
    flex-grow: 1;
    border: 1px solid #ddd;
    border-radius: 20px 0 0 20px;
    padding: 10px 15px;
    outline: none;
}
.mf-field button {
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 0 20px 20px 0;
    cursor: pointer;
    font-weight: 600;
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
          <div class="messages-list" style="max-height: 50vh; overflow-y: auto;">
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
                <img id="chatUserImg" src="https://via.placeholder.com/50" alt="Profile Image">
              </div>
              <div class="usr-mg-info">
                <h3 id="chatUserName">Select a user</h3>
                <p id="chatUserStatus">Online</p>
              </div>
            </div>
          </div>

          <!-- CHAT MESSAGES -->
          <div class="messages-line" id="chatBox">
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

<!-- --- SCRIPTS FOR CHAT SYSTEM --- -->
<!-- Set BASE_URL constant for JavaScript use -->
<script>
    const BASE_URL = '{{ url('/') }}';
</script>

<!-- Load jQuery (required for your script and AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load Laravel Echo & Pusher (for real-time chat) -->
<!-- NOTE: You must include your app.js file which initializes Echo (Pusher/Websockets) -->
<!-- Example for Laravel Mix/Vite compiled asset: -->
<!-- <script src="{{ asset('js/app.js') }}"></script> -->

<!-- Load the custom chat logic -->
<script src="{{ asset('js/chat_script.js') }}"></script> 
<!-- If you are including the logic inline, use the content from Chat Logic Script file here -->

@endsection