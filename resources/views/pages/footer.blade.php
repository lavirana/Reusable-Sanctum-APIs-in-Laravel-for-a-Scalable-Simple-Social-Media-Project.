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
  // if token exists, ensure header set (for page reloads)
  const token = localStorage.getItem('token');
  if (token) axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

  // helper: escape text to avoid XSS when injecting HTML
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
        <div class="usy-dt" style="margin-right: 10px;">
									<img src="http://localhost:8000/images/lavi.jpg" alt="" style="width: 36px;border: 1px solid #3ab07f;">
					</div>
            <h5>${escapeHtml(p.title)}</h5>
            <p>${escapeHtml(p.body)}</p>
          <p class="text-muted small" style="margin-bottom: 5px;" >By ${escapeHtml(p.user?.name || 'Unknown')}</p>
          <button class="btn btn-sm btn-outline-primary" onclick="toggleLike(${p.id}, this)">
            ❤️ <span id="likes-count-${p.id}">${p.likes_count ?? ''}</span>
          </button>
          <button class="btn btn-sm btn-outline-secondary" onclick="openComments(${p.id})">
            💬 Comments
          </button>
        </div>
      </div>
    `).join('');

    document.getElementById('postsContainer').innerHTML = html;
  }

  // GET posts
  axios.get('/posts')
    .then(res => {
      renderPosts(res.data);
    })
    .catch(err => {
      console.error(err);
      if (err.response && err.response.status === 401) {
        // not authenticated — redirect to login or show login UI
        window.location.href = '/login';
      } else {
        document.getElementById('postsContainer').innerHTML = '<p>Error loading posts.</p>';
      }
    });

  // Make toggleLike global so buttons can call it
  window.toggleLike = function(postId, btn) {
    axios.post(`/posts/${postId}/like`)
      .then(res => {
        // Optionally update UI
        const status = res.data.status; // 'liked' or 'unliked'
        // Increase/decrease likes count (if provided)
        const span = document.getElementById(`likes-count-${postId}`);
        if (span) {
          let n = parseInt(span.textContent || '0');
          n = status === 'liked' ? n + 1 : Math.max(0, n - 1);
          span.textContent = n;
        }
      })
      .catch(err => {
        if (err.response && err.response.status === 401) {
          window.location.href = '/login';
        } else {
          alert('Error toggling like');
        }
      });
  };

  // Example comments loader
  window.openComments = function(postId) {
    axios.get(`/posts/${postId}/comments`)
      .then(res => {
         // show comments in a modal or below post
         console.log('comments:', res.data);
         alert('Check console for comments (implement UI)');
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