<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.mCustomScrollbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/scrollbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
<!-- FIX: Is ReferenceError: $ is not defined ke liye, jQuery CDN ko load karna zaroori hai. -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
<script>
  const BASE_URL = "http://127.0.0.1:8000";
  document.addEventListener('DOMContentLoaded', function() {
    axios.defaults.baseURL = '/api';
    const token = localStorage.getItem('token');
    if (token) axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

    function escapeHtml(unsafe) {
      return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    }

    function renderPosts(posts) {
      if (!posts.length) {
        document.getElementById('postsContainer').innerHTML = '<p>No posts yet.</p>';
        return;
      }

      const html = posts.map(p => `
      <div class="card mb-3" id="post-${p.id}">
        <div class="card-body" style="padding:10px;">
          <div class="d-flex align-items-center mb-2">
            <img src="${BASE_URL}/images/lavi.jpg" alt="" style="width:36px;height:36px;border-radius:50%;border:1px solid #3ab07f;margin-right:10px;">
            <strong>${escapeHtml(p.user?.name || 'Unknown')}</strong>
          </div>
          <h5>${escapeHtml(p.title)}</h5>
          <p>${escapeHtml(p.body)}</p>

          <button class="btn btn-sm btn-outline-primary" onclick="toggleLike(${p.id}, this)">
            ❤️ <span id="likes-count-${p.id}">${p.likes_count ?? 0}</span>
          </button>
          <button class="btn btn-sm btn-outline-secondary" onclick="toggleComments(${p.id})">
            💬 Comments
          </button>

          <!-- comments area -->
          <div id="comments-container-${p.id}" class="comments-area mt-2" style="display:none;">
            <div class="comments-list mb-2" id="comments-list-${p.id}" style="padding-left:10px;"></div>
            <div class="input-group input-group-sm">
              <input type="text" id="comment-input-${p.id}" class="form-control" placeholder="Write a comment...">
              <button class="btn btn-success" onclick="addComment(${p.id})">Post</button>
            </div>
          </div>
        </div>
      </div>
    `).join('');

      document.getElementById('postsContainer').innerHTML = html;
    }

    // Fetch posts initially
    axios.get('/posts')
      .then(res => renderPosts(res.data))
      .catch(err => {
        console.error(err);
        if (err.response && err.response.status === 401) window.location.href = '/login';
        else document.getElementById('postsContainer').innerHTML = '<p>Error loading posts.</p>';
      });

    // Like function
    window.toggleLike = function(postId, btn) {
      axios.post(`/posts/${postId}/like`)
        .then(res => {
          const status = res.data.status;
          const span = document.getElementById(`likes-count-${postId}`);
          if (span) {
            let n = parseInt(span.textContent || '0');
            n = status === 'liked' ? n + 1 : Math.max(0, n - 1);
            span.textContent = n;
          }
        })
        .catch(err => {
          if (err.response && err.response.status === 401) window.location.href = '/login';
          else alert('Error toggling like');
        });
    };

    // Show/hide comments
    window.toggleComments = function(postId) {
      const container = document.getElementById(`comments-container-${postId}`);
      if (container.style.display === 'none') {
        container.style.display = 'block';
        loadComments(postId);
      } else {
        container.style.display = 'none';
      }
    };

    // Load comments
    function loadComments(postId) {
      axios.get(`/posts/${postId}/comments`)
        .then(res => {
          const list = document.getElementById(`comments-list-${postId}`);
          if (!res.data.length) {
            list.innerHTML = `<p class="text-muted small">No comments yet.</p>`;
            return;
          }
          list.innerHTML = res.data.map(c => `
          <div class="comment-item mb-1 p-1 border-bottom">
            <strong>${escapeHtml(c.user?.name || 'Anon')}</strong>: ${escapeHtml(c.body)}
          </div>
        `).join('');
        })
        .catch(err => {
          console.error(err);
        });
    }

    // Add comment
    window.addComment = function(postId) {
      const input = document.getElementById(`comment-input-${postId}`);
      const text = input.value.trim();
      if (!text) return;

      axios.post(`/posts/${postId}/comments`, {
          body: text
        })
        .then(() => {
          input.value = '';
          loadComments(postId);
        })
        .catch(err => {
          if (err.response && err.response.status === 401) window.location.href = '/login';
          else alert('Error adding comment');
        });
    };
  });
</script>

<script>
  // Get the saved token
  const token = localStorage.getItem('token');

  // Logout request
  async function logout() {
    try {
      await axios.post('${BASE_URL}/api/logout', {}, {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      });
    } catch (error) {
      console.error('Logout failed:', error);
    } finally {
      // Clear token and redirect
      localStorage.removeItem('token');
      alert('Logged out successfully!');
      window.location.href = 'login';
    }
  }
</script>

<script>
  $(document).ready(function() {
    $('.add_post').click(function(e) {
      e.preventDefault();

      const title = $('#post_title').val();
      const body = $('#post_body').val();
      const token = localStorage.getItem('token');

      if (!title || !body) {
        alert('Please enter both title and body!');
        return;
      }

      if (!token) {
        alert('You are not logged in!');
        return;
      }

      $.ajax({
        url: '/api/posts',
        type: 'POST',
        headers: {
          'Authorization': 'Bearer ' + token,
          'Accept': 'application/json'
        },
        data: {
          title: title,
          body: body
        },
        success: function(response) {
          alert('✅ Post created successfully!');
          $('#post_title').val('');
          $('#post_body').val('');
          window.location.href = '/';
        },
        error: function(xhr) {
          console.log(xhr.responseText);
          alert('❌ Failed to create post. Check console for details.');
        }
      });
    });
  });
</script>


<script>
  $(document).ready(function() {
    const userId = $('.setprofileUserId').val(); // Profile being viewed (from hidden input)
    const token = localStorage.getItem('token'); // Logged-in user's token
    const $btn = $('.followBtn'); // Follow/Unfollow button

    // Initially hide the button (we’ll show it later if needed)
    $btn.css('display', 'none');

    if (!userId || !token) return;

    // Step 1: Get logged-in user info
    $.ajax({
      url: `${BASE_URL}/api/v1/me`,
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      },
      success: function(res) {
        // make sure res.user exists or fallback
        const loggedInUserId = res.id || (res.user && res.user.id);
        // Step 2: Hide Follow button if viewing own profile
        if (parseInt(userId) === parseInt(loggedInUserId)) {
          $btn.css('display', 'none'); // ✅ Hide using display:none
          return; // Stop further code
        }

        // Otherwise, show and set button state
        $btn.css('display', 'inline-block'); // ✅ Show button for other users
        updateButton('unfollowed');
      },
      error: function(xhr) {
        console.error('Failed to fetch user info.', xhr.responseText);
      }
    });

    // Step 3: Function to update button appearance
    function updateButton(status) {
      const isFollowed = status === 'followed';
      $btn.text(isFollowed ? 'Unfollow' : 'Follow')
        .css('background', isFollowed ? '#e53935' : '#00796b')
        .prop('disabled', false);
    }

    // Step 4: Follow/Unfollow click handler
    $btn.on('click', function() {
      $btn.prop('disabled', true).text('Please wait...');

      $.ajax({
        url: `${BASE_URL}/api/follow/${userId}`,
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json'
        },
        success(res) {
          updateButton(res.status || 'unfollowed');
        },
        error() {
          alert('Something went wrong.');
          $btn.prop('disabled', false).text('Follow');
        }
      });
    });
  });
</script>




<script>
  $(document).ready(function() {

    const token = localStorage.getItem('token'); // Sanctum token
    $.ajax({
      url: `${BASE_URL}/api/v1/me`,
      type: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      },
      success: function(res) {

        $('.user-profile h3').text(res.name);
        $('.setprofileUserId').val(res.id);
        $('.followers').text(res.followers_count);
        $('.following').text(res.following_count);

        if (res.profile_photo) {
          $('.usr-pic img').attr('src', "${BASE_URL}/images/" + res.profile_photo);
        }
      },
      error: function(xhr) {
        console.error('Error:', xhr.responseText);
      }
    });

  });
</script>


<script>
  $(document).ready(function() {
    // -------------------------------------------------------------------
    // 1. Retrieve essential constants from the HTML/Blade
    // NOTE: BASE_URL must be defined earlier in your Blade template (as discussed previously)
    const token = localStorage.getItem('token');
    const $list = $('.users-list');
    
    // Check for the CSRF token in the meta tag
    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    // Initial validation
    if (!token) {
      console.error("Token not found. Please login first.");
      return;
    }
    if (!CSRF_TOKEN) {
      console.error("CSRF token not found. Check your Blade view for the <meta name='csrf-token' ...>");
    }
    // -------------------------------------------------------------------


    // Fetch logged-in user info first (GET request - no CSRF needed)
    $.ajax({
      url: `${BASE_URL}/api/v1/me`,
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      },
      success: function(me) {
        const loggedInUserId = me.id;

        // Fetch all users except logged-in one
        $.ajax({
          url: `${BASE_URL}/api/v1/all_users`,
          method: 'GET',
          headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
          },
          success: function(res) {
            $list.empty();
            if (res.users && res.users.length > 0) {
              res.users.forEach(function(user, index) {
                // Skip the logged-in user
                if (user.id === loggedInUserId) return;

                const isFollowed = user.is_following || false; 
                const btnText = isFollowed ? 'Unfollow' : 'Follow';
                const btnColor = isFollowed ? '#e53935' : '#43cea2';

                const userHtml = `
              <a href="profile-detail/${user.id}">
  <div class="suggestion-usd" data-user-id="${user.id}">
    <!-- Left: Profile Info -->
    <div class="user-info">
      <img 
        src="${user.profile_photo_path 
                ? `${BASE_URL}/` + user.profile_photo_path 
                : 'https://i.pravatar.cc/60?img=' + (index + 1)}"
        alt="${user.name}">
      <h4>${user.name}</h4>
    </div>
    <!-- Right: Actions -->
    <div class="user-actions">
      <a href="${BASE_URL}/messages/${user.id}" class="btn btn-message" style="background: linear-gradient(135deg, var(--btn-color, #43cea2), #185a9d); color:#fff;">Message</a>
      <button style="background: linear-gradient(135deg, var(--btn-color, #43cea2), #185a9d); color:#fff; " class="btn btn-follow" 
              data-status="${isFollowed ? 'followed' : 'unfollowed'}" 
              style="--btn-color:${btnColor};">
        ${btnText}
      </button>
    </div>

  </div>
</a>`;
                $list.append(userHtml);
              });
            } else {
              $list.html('<p>No users found.</p>');
            }
          },
          error: function(err) {
            console.error('Error loading users:', err);
            $list.html('<p style="color:red;">Failed to load users.</p>');
          }
        });
      },
      error: function() {
        console.error("Couldn't fetch logged-in user info");
      }
    });

    // Handle Follow/Unfollow Button Click
    $(document).on('click', '.btn-follow', function() {
      const $btn = $(this);
      const userId = $btn.closest('.suggestion-usd').data('user-id');
      const currentStatus = $btn.data('status');

      // Check if token exists before proceeding
      if (!CSRF_TOKEN) {
         alert('CSRF token is missing. Cannot perform action.');
         return;
      }
      $btn.prop('disabled', true).text('Please wait...');

      $.ajax({
        url: `${BASE_URL}/api/follow/${userId}`,
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json',
          // **CRITICAL FIX: ADD THE CSRF TOKEN TO THE HEADERS**
          'X-CSRF-TOKEN': CSRF_TOKEN 
        },
        success: function(res) {
          console.log('Follow/Unfollow response:', res);
          const newStatus = res.status || (currentStatus === 'followed' ? 'unfollowed' : 'followed');
          const isFollowed = newStatus === 'followed';

          $btn.text(isFollowed ? 'Unfollow' : 'Follow')
            .data('status', newStatus)
            .css('background', isFollowed ?
              'linear-gradient(135deg,#e53935,#b71c1c)' :
              'linear-gradient(135deg,#43cea2,#185a9d)')
            .prop('disabled', false);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('Follow/Unfollow failed:', jqXHR.responseText);
          // Alert specific error if it's the CSRF mismatch we are debugging
          alert('Error during follow operation. Check console for details.');
          $btn.prop('disabled', false).text(currentStatus === 'followed' ? 'Unfollow' : 'Follow');
        }
      });
    });
  });
</script>

<script>
  $(document).ready(function() {
    $.ajax({
      url: `${BASE_URL}/api/v1/most-viewed`,
      type: 'GET',
      success: function(res) {
        let html = '';
        res.forEach(user => {
          html += `
                    <div class="viewed-user-card">
                        <h4>${user.name}</h4>
                        <p>Total Views: ${user.total_views}</p>
                    </div>
                `;
        });
        $('#mostViewedList').html(html);
      },
      error: function(xhr) {
        console.error(xhr.responseText);
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    const token = localStorage.getItem('token');
    if (!token) {
      console.error("Token not found. Please login first.");
      return;
    }
    $.ajax({
      url: `${BASE_URL}/get_user/2`,
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      },
      success: function(res) {
        $('#profileName').text(res.user.name);
        if (res.user.cover_photo) {
          $('#coverImage').attr('src', `${BASE_URL}/` + res.user.cover_photo);
        }
        $('#userEmail').text(res.user.email);
      },
      error: function(xhr) {
        console.error('Error fetching profile info:', xhr.responseText);
      }
    });
  });
</script>

<!--<script>
  $(document).ready(function() {
    const token = localStorage.getItem('token');
    let loggedInUserId = null;
    let selectedReceiverId = null;
  // Fetching CSRF token for web routes (though we aim for API routes)
 
    // Step 1: Load logged-in user
    function getLoggedInUser() {
      return $.ajax({
        url: `${BASE_URL}/api/user`,
        method: 'GET',
        headers: {
          'Authorization': `Bearer ${token}`
        }
      });
    }

    // Step 2: Load user list
    function loadUsers() {
      $.ajax({
        url: `${BASE_URL}/api/v1/all_users`,
        method: 'GET',
        headers: {
          'Authorization': `Bearer ${token}`
        },
        success: function(response) {
          const userList = $('#userList');
          userList.empty();

          response.users.forEach(user => {
            if (user.id !== loggedInUserId) {
              userList.append(`
              <li class="user-item" data-id="${user.id}" style="cursor:pointer;">
                <div class="usr-msg-details">
                  <div class="usr-ms-img">
                    <img src="${user.profile_photo_url || 'https://via.placeholder.com/50'}" alt="">
                  </div>
                  <div class="usr-mg-info">
                    <h3>${user.name}</h3>
                    <p>${user.email}</p>
                  </div>
                </div>
              </li>
            `);
            }
          });
        },
        error: function(err) {
          console.error('Error loading users:', err);
        }
      });
    }

    // Step 3: Load messages between logged-in user and receiver
    function loadMessages(receiverId) {
      if (!loggedInUserId) {
        console.warn("User not yet loaded...");
        return;
      }

      $.ajax({
        url: `${BASE_URL}/api/messages/${receiverId}`,
        method: 'GET',
        headers: {
          'Authorization': `Bearer ${token}`
        },
        success: function(response) {
          const chatBox = $('#chatBox');
          chatBox.empty();

          if (!response.messages || response.messages.length === 0) {
            chatBox.html('<p class="text-center text-muted">No messages yet</p>');
            return;
          }

          response.messages.forEach(msg => {
            const align = (msg.sender_id === loggedInUserId) ? 'right' : 'left';
            const html = `
            <div class="msg ${align}">
              <div class="message-inner-dt"><p>${msg.message}</p></div>
            </div>`;
            chatBox.append(html);
          });

          chatBox.scrollTop(chatBox[0].scrollHeight);
        },
        error: function(err) {
          console.error('Error loading messages:', err);
        }
      });
    }

    // Step 4: Handle user click (open chat)
    $(document).on('click', '.user-item', function() {
      selectedReceiverId = $(this).data('id');
      const userName = $(this).find('h3').text();
      const userImg = $(this).find('img').attr('src');
      

      $('#chatUserName').text(userName);
      $('#chatUserImg').attr('src', userImg);
      $('#receiverId').val(selectedReceiverId);

      loadMessages(selectedReceiverId);
    });

    // Step 5: Send message
    $('#sendMessageForm').on('submit', function(e) {
      e.preventDefault();
      const message = $('#messageInput').val().trim();
      

      if (!selectedReceiverId) return alert('Please select a user first!');
      if (!message) return;

      $.ajax({
        url: `${BASE_URL}/api/messages/send`,
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`
        },
        data: {
          receiver_id: selectedReceiverId,
          message
        },
        success: function() {
          $('#chatBox').append(`
          <div class="msg right">
            <div class="message-inner-dt"><p>${message}</p></div>
          </div>
        `);
          $('#messageInput').val('');
          $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
        },
        error: function(err) {
          console.error('Error sending message:', err);
        }
      });
    });

    // Step 6: Initialize everything
    getLoggedInUser().done(user => {
      loggedInUserId = user.id;
      console.log("Logged-in ID:", loggedInUserId);
      loadUsers();
    }).fail(err => {
      console.error("Error fetching user info:", err);
    });
  });
</script>-->


<script>
  $(document).ready(function() {
    // --- Configuration and Initialization ---
    // Ensure BASE_URL is defined globally in your layout, e.g., 
    const token = localStorage.getItem('token');
    let loggedInUserId = null;
    let selectedReceiverId = null;
    let currentChannel = null; // To track the current Echo channel
    
    // Check for token
    if (!token) {
        console.error("Authentication token not found. User needs to log in.");
        return;
    }

    // --- Core Functions ---

    // 1. Load logged-in user details
    function getLoggedInUser() {
        return $.ajax({
            url: `${BASE_URL}/api/user`,
            method: 'GET',
            headers: { 'Authorization': `Bearer ${token}` }
        });
    }

    // 2. Load list of users for sidebar
    function loadUsers() {
        $.ajax({
            url: `${BASE_URL}/api/v1/all_users`,
            method: 'GET',
            headers: { 'Authorization': `Bearer ${token}` },
            success: function(response) {
                const userList = $('#userList');
                userList.empty();

                if (!response.users || response.users.length === 0) {
                     userList.html('<p class="text-center text-muted p-3">No other users found.</p>');
                     return;
                }

                response.users.forEach(user => {
                    // Check if user is loggedInUserId because the API endpoint usually filters it out
                    if (user.id !== loggedInUserId) {
                        userList.append(`
                            <li class="user-item" data-id="${user.id}" data-name="${user.name}" style="cursor:pointer;">
                                <div class="usr-msg-details">
                                    <div class="usr-ms-img">
                                        <img src="${user.profile_photo_url || 'https://via.placeholder.com/50?text=U'}" alt="${user.name}">
                                    </div>
                                    <div class="usr-mg-info">
                                        <h3>${user.name}</h3>
                                        <p>${user.email}</p>
                                    </div>
                                </div>
                            </li>
                        `);
                    }
                });
            },
            error: function(err) {
                console.error('Error loading users:', err);
            }
        });
    }

    // 3. Render a single message HTML element
    function renderMessage(msg, align) {
        return `
            <div class="msg ${align}">
                <div class="message-inner-dt"><p>${msg.message}</p></div>
            </div>`;
    }
    
    // 4. Load messages between logged-in user and selected receiver
    function loadMessages(receiverId) {
      const chatBox = $('#chatBox');
      chatBox.html('<p class="text-center text-muted mt-3">Loading messages...</p>');

      $.ajax({
        url: `${BASE_URL}/api/messages/${receiverId}`,
        method: 'GET',
        headers: { 'Authorization': `Bearer ${token}` },
        success: function(response) {
          chatBox.empty();

          if (!response.messages || response.messages.length === 0) {
            chatBox.html('<p class="text-center text-muted mt-3">Start the conversation!</p>');
            return;
          }

          response.messages.forEach(msg => {
            const align = (msg.sender_id === loggedInUserId) ? 'right' : 'left';
            chatBox.append(renderMessage(msg, align));
          });

          // Scroll to the bottom after loading
          chatBox.scrollTop(chatBox[0].scrollHeight);
        },
        error: function(err) {
          console.error('Error loading messages:', err);
          chatBox.html('<p class="text-center text-danger mt-3">Failed to load messages.</p>');
        }
      });
    }

    // 5. Setup Echo Listener for real-time updates
    function setupRealTimeListener(receiverId) {
        if (!window.Echo) {
            console.warn("Laravel Echo is not loaded. Real-time chat disabled.");
            return;
        }

        // Leave the previous channel if one was active
        if (currentChannel) {
            window.Echo.leave(currentChannel);
        }

        // Determine the channel name (must match MessageSent event logic)
        const ids = [parseInt(loggedInUserId), parseInt(receiverId)].sort((a, b) => a - b);
        const channelName = `private-chat.${ids.join('.')}`; // Use private- prefix if using PrivateChannel
        currentChannel = channelName; 

        window.Echo.private(channelName)
            .listen('MessageSent', (e) => {
                const msg = e.message;
                // Only process if the message is from the *other* user in this chat
                if (msg.sender_id === parseInt(receiverId)) {
                    const chatBox = $('#chatBox');
                    chatBox.append(renderMessage(msg, 'left'));
                    chatBox.scrollTop(chatBox[0].scrollHeight);
                }
            })
            .error((error) => {
                console.error('Echo Channel Error:', error);
            });
    }
    
    // --- Event Handlers ---

    // Handle user click (open chat)
    $(document).on('click', '.user-item', function() {
        // Remove active class from previous item
        $('.user-item').removeClass('active');
        $(this).addClass('active');

        selectedReceiverId = $(this).data('id');
        const userName = $(this).data('name');
        const userImg = $(this).find('img').attr('src');
        
        // Update chat header details
        $('#chatUserName').text(userName);
        $('#chatUserImg').attr('src', userImg);
        $('#receiverId').val(selectedReceiverId);
        
        // Enable input area
        $('#messageInput').prop('disabled', false).focus();
        $('#sendBtn').prop('disabled', false);

        // Fetch history and start real-time listener
        loadMessages(selectedReceiverId);
        setupRealTimeListener(selectedReceiverId);
    });


    // Handle message sending
    $('#sendMessageForm').on('submit', function(e) {
        e.preventDefault();
        const message = $('#messageInput').val().trim();
        if (!selectedReceiverId) return alert('Please select a user first!');
        if (!message) return;
        
        // Optimistic update: show message immediately
        const chatBox = $('#chatBox');
        chatBox.append(renderMessage({ message: message }, 'right'));
        chatBox.scrollTop(chatBox[0].scrollHeight);
        $('#messageInput').val('').prop('disabled', true); // Disable input while sending

        $.ajax({
            url: `${BASE_URL}/api/messages/send`,
            method: 'POST',
            headers: { 
                'Authorization': `Bearer ${token}`,
                'X-Requested-With': 'XMLHttpRequest' // Helps bypass potential 419 errors
            },
            data: {
               "_token": "{{ csrf_token() }}",
                receiver_id: selectedReceiverId,
                message
            },  
            success: function(res) {
                // If successful, re-enable input
                $('#messageInput').prop('disabled', false).focus();
            },
            error: function(err) {
                console.error('Error sending message:', err);
                // Revert optimistic update and inform user
                alert('Message failed to send. Check console.');
                chatBox.children().last().remove(); // Remove the optimistically added message
                $('#messageInput').val(message).prop('disabled', false).focus();
            }
        });
    });

    // --- Initialization ---
    getLoggedInUser().done(user => {
        loggedInUserId = user.id;
        // Set up the meta tag needed for Echo authentication
        $('head').append(`<meta name="user-id" content="${loggedInUserId}">`);
        loadUsers();
    }).fail(err => {
        console.error("Error fetching user info:", err);
        alert("Could not load user data. Please ensure you are logged in.");
    });
    
    // Initially disable input
    $('#messageInput').prop('disabled', true);
    $('#sendBtn').prop('disabled', true);

});
</script>

<script>
  $(document).ready(function() {
        $("#search").on('keyup', function() {
          let query = $(this).val();
          if (query.length > 1) {
            $.ajax({
              url: "{{ route('search') }}",
              method: 'GET',
              data: {
                q: query
              },
              success: function(response) {
                let output = '';
                if (response.users.length === 0 && response.posts.length === 0) {
                  output = '<div class="list-group-item">No results found</div>';
                } else {
                  response.users.forEach(user => {
                    output += `<a href="/user/${user.id}" class="list-group-item list-group-item-action">👤 ${user.name}</a>`;
                  });
                  response.posts.forEach(post => {
                    output += `<a href="/post/${post.id}" class="list-group-item list-group-item-action">📝 ${post.title}</a>`;
                  });
                }
                $('#search-results').html(output).show();
              }
            });
          } else {
            $('#search-results').hide();
        }
        });
         // hide results on click outside
    $(document).click(function(e){
        if(!$(e.target).closest('#search, #search-results').length){
            $('#search-results').hide();
        }
    });
      });
</script>

<script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                const passwordInput = $('#passwordInput');
                const toggleIcon = $('#toggleIcon');
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                toggleIcon.toggleClass('fa-eye fa-eye-slash');
            });
        });
    </script>

</html>