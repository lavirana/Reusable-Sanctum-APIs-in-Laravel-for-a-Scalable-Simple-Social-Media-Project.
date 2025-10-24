<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.mCustomScrollbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/scrollbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
</body>
<script>
document.addEventListener('DOMContentLoaded', function () {
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
            <img src="http://localhost:8000/images/lavi.jpg" alt="" style="width:36px;height:36px;border-radius:50%;border:1px solid #3ab07f;margin-right:10px;">
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

    axios.post(`/posts/${postId}/comments`, { body: text })
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
    await axios.post('http://localhost:8000/api/logout', {}, {
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
$(document).ready(function(){
  $('.add_post').click(function(e){
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
      data: { title: title, body: body },
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

  const userId = $('.setprofileUserId').val();   // Profile being viewed (from hidden input)
  const token  = localStorage.getItem('token');  // Logged-in user's token
  const $btn   = $('.followBtn');                // Follow/Unfollow button

  // Initially hide the button (we’ll show it later if needed)
  $btn.css('display', 'none');

  if (!userId || !token) return;

  // Step 1: Get logged-in user info
  $.ajax({
    url: 'http://localhost:8000/api/v1/me',
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Accept': 'application/json'
    },
    success: function(res) {
      // make sure res.user exists or fallback
      const loggedInUserId = res.id || (res.user && res.user.id);
      console.log('Logged-in User ID:', loggedInUserId, 'Profile User ID:', userId);

      // Step 2: Hide Follow button if viewing own profile
      if (parseInt(userId) === parseInt(loggedInUserId)) {
        console.log('Own profile detected — hiding follow button');
        $btn.css('display', 'none');  // ✅ Hide using display:none
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
      url: `http://localhost:8000/api/follow/${userId}`,
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
        url: '/api/v1/me',
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
                $('.usr-pic img').attr('src', 'http://localhost:8000/images/' + res.profile_photo);
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
  const token = localStorage.getItem('token');
  const $list = $('.users-list');

  if (!token) {
    console.error("Token not found. Please login first.");
    return;
  }

  // Fetch logged-in user info first
  $.ajax({
    url: 'http://localhost:8000/api/v1/me',
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Accept': 'application/json'
    },
    success: function(me) {
      const loggedInUserId = me.id;

      // Fetch all users except logged-in one
      $.ajax({
        url: 'http://localhost:8000/api/v1/all_users',
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

              const isFollowed = user.is_following || false; // API should send this
              const btnText = isFollowed ? 'Unfollow' : 'Follow';
              const btnColor = isFollowed ? '#e53935' : '#43cea2';

              const userHtml = `
               <a href="my-profile/${user.id}"><div class="suggestion-usd" 
                     data-user-id="${user.id}"
                     style="display:flex;align-items:center;margin-bottom:12px;
                            padding:10px;border-radius:8px;background:#f8f9fa;">
                  <img src="${user.profile_photo_path 
                              ? 'http://localhost:8000/' + user.profile_photo_path 
                              : 'https://i.pravatar.cc/60?img=' + (index + 1)}"
                       alt="${user.name}" 
                       style="border-radius:50%;width:50px;height:50px;object-fit:cover;">
                  <div style="flex:1;margin-left:10px;">
                    <h4 style="margin:0;font-size:15px;">${user.name}</h4>
                  </div>
                  <button class="btn-sm btn-follow" 
                          data-status="${isFollowed ? 'followed' : 'unfollowed'}"
                          style="background:linear-gradient(135deg,${btnColor},#185a9d);
                                 color:#fff;border:none;padding:6px 10px;border-radius:4px;">
                    ${btnText}
                  </button>
                </div></a>
              `;
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

    $btn.prop('disabled', true).text('Please wait...');

    $.ajax({
      url: `http://localhost:8000/api/follow/${userId}`,
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      },
      success: function(res) {
        const newStatus = res.status || (currentStatus === 'followed' ? 'unfollowed' : 'followed');
        const isFollowed = newStatus === 'followed';

        $btn.text(isFollowed ? 'Unfollow' : 'Follow')
            .data('status', newStatus)
            .css('background', isFollowed 
                ? 'linear-gradient(135deg,#e53935,#b71c1c)'
                : 'linear-gradient(135deg,#43cea2,#185a9d)')
            .prop('disabled', false);
      },
      error: function() {
        alert('Something went wrong.');
        $btn.prop('disabled', false).text('Follow');
      }
    });
  });
});
</script>


<script>
$(document).ready(function() {
    $.ajax({
        url: 'http://localhost:8000/api/v1/most-viewed',
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
        url: 'http://localhost:8000/get_user/2',
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        },
        success: function(res) {
            $('#profileName').text(res.user.name);
            if (res.user.cover_photo) {
                $('#coverImage').attr('src', 'http://localhost:8000/' + res.user.cover_photo);
            }
            $('#userEmail').text(res.user.email);
        },
        error: function(xhr) {
            console.error('Error fetching profile info:', xhr.responseText);
        }
    });
});

</script>

<script>
$(document).ready(function() {
    const token = localStorage.getItem('token'); // if using Sanctum

    
    window.openChat = function(receiverId) {
        $('#receiverId').val(receiverId);
        $('#chatBox').html('<p class="text-center text-muted">Loading messages...</p>');
        
        $.ajax({
            url: `http://localhost:8000/api/messages/${receiverId}`,
            method: 'GET',
            headers: { 'Authorization': `Bearer ${token}` },
            success: function(response) {
                const chatBox = $('#chatBox');
                chatBox.html('');
                response.messages.forEach(msg => {
                    const align = msg.sender_id === {{ auth()->id() }} ? 'right' : 'left';
                    const messageHtml = `
                        <div class="msg ${align}">
                            <div class="message-inner-dt">
                                <p>${msg.message}</p>
                            </div>
                        </div>`;
                    chatBox.append(messageHtml);
                });
                chatBox.scrollTop(chatBox[0].scrollHeight);
            },
            error: function(err) {
                console.error('Error loading chat:', err);
            }
        });
    };

    // 👇 Send message
    $('#sendBtn').click(function() {
        const receiverId = $('#receiverId').val();
        const message = $('#messageInput').val();

        if (!receiverId) {
            alert('Please select a user first!');
            return;
        }
        if (!message.trim()) return;

        $.ajax({
            url: 'http://localhost:8000/api/messages/send',
            method: 'POST',
            headers: { 'Authorization': `Bearer ${token}` },
            data: { receiver_id: receiverId, message: message },
            success: function(response) {
                $('#chatBox').append(`
                    <div class="msg right">
                        <div class="message-inner-dt">
                            <p>${message}</p>
                        </div>
                    </div>
                `);
                $('#messageInput').val('');
                const chatBox = $('#chatBox');
                chatBox.scrollTop(chatBox[0].scrollHeight);
            },
            error: function(err) {
                console.error('Error sending message:', err);
            }
        });
    });
});
</script>

</html>