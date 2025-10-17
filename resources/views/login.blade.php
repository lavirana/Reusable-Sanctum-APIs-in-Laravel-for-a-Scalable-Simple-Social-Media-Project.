
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/animate.css">
	<link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/line-awesome.css">
	<link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/line-awesome-font-awesome.min.css">
	<link href="https://gambolthemes.net/workwise-new/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/lib/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/lib/slick/slick-theme.css">
	<link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/responsive.css">
</head>
<body class="sign-in" style="background: linear-gradient(135deg, #43cea2, #185a9d)">
	<div class="wrapper">		
		<div class="sign-in-page">
			<div class="signin-popup">
				<div class="signin-pop">
					<div class="row">
						<div class="col-lg-12">
							<div class="login-sec">
								<div class="sign_in_sec current" id="tab-1">
									<h3>Sign in</h3>
									<div id="loginError" style="color:red;display:none;margin-bottom:10px"></div>

									<form id="loginForm">
										<div class="row">
											<div class="col-lg-12 no-pdd">
												<div class="sn-field">
													<input type="email" name="email" id="email" placeholder="Email" required>
													<i class="la la-user"></i>
												</div><!--sn-field end-->
											</div>
											<div class="col-lg-12 no-pdd">
												<div class="sn-field">
													<input type="password" name="password" id="password" placeholder="Password" required>
													<i class="la la-lock"></i>
												</div>
											</div>
									
											<div class="col-lg-12 no-pdd">
												<button type="submit" value="submit" style="background: linear-gradient(135deg, #43cea2, #185a9d)">Sign in</button>
											</div>
										</div>
									</form>
								</div><!--sign_in_sec end-->
								<div class="sign_in_sec" id="tab-2">
									<div class="signup-tab">
										<i class="fa fa-long-arrow-left"></i>
										<h2>johndoe@example.com</h2>
										<ul>
											<li data-tab="tab-3" class="current"><a href="#" title="">User</a></li>
											<li data-tab="tab-4"><a href="#" title="">Company</a></li>
										</ul>
									</div><!--signup-tab end-->	
								</div>		
							</div><!--login-sec end-->
						</div>
					</div>		
				</div><!--signin-pop end-->
			</div><!--signin-popup end-->
		</div><!--sign-in-page end-->
	</div><!--theme-layout end-->
<script type="text/javascript" src="https://gambolthemes.net/workwise-new/js/jquery.min.js"></script>
<script type="text/javascript" src="https://gambolthemes.net/workwise-new/js/popper.js"></script>
<script type="text/javascript" src="https://gambolthemes.net/workwise-new/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://gambolthemes.net/workwise-new/lib/slick/slick.min.js"></script>
<script type="text/javascript" src="https://gambolthemes.net/workwise-new/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Make sure axios baseURL points to /api
  axios.defaults.baseURL = '/api';

  // If token exists on page load, set Authorization header
  const savedToken = localStorage.getItem('token');
  if (savedToken) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${savedToken}`;
  }

  const form = document.getElementById('loginForm');
  const errorBox = document.getElementById('loginError');

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    errorBox.style.display = 'none';

    const payload = {
      email: document.getElementById('email').value,
      password: document.getElementById('password').value
    };

    axios.post('/v1/login', payload)
      .then(res => {
        // Example response: { user: {...}, token: "..." }
        const token = res.data.token;
        if (!token) {
          errorBox.textContent = 'Login response missing token';
          errorBox.style.display = 'block';
          return;
        }

        // 1) store token (localStorage)
        localStorage.setItem('token', token);

        // 2) set default header for future axios requests
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

        // 3) redirect to home (or reload to reflect auth)
        window.location.href = '/';
      })
      .catch(err => {
        console.error(err);
        let msg = 'Login failed';
        if (err.response && err.response.data && err.response.data.message) {
          msg = err.response.data.message;
        } else if (err.message) {
          msg = err.message;
        }
        errorBox.textContent = msg;
        errorBox.style.display = 'block';
      });
  });
});
</script>
</html>

