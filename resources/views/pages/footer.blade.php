<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.mCustomScrollbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/slick/slick.min.js') }}"></script>
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


</html>