@extends('pages.layout')
@section('content')
<main>
	<div class="main-section">
		<div class="container">
			<div class="main-section-data">
				<div class="row">
					<div class="col-lg-3 col-md-4 pd-left-none no-pd">
						<div class="main-left-sidebar no-margin">
							<div class="user-data full-width">
								<div class="user-profile">
			                       <div class="username-dt" style="background: linear-gradient(135deg, #43cea2, #185a9d);">
										<div class="usr-pic">
											<img src="http://localhost:8000/images/lavi.jpg" alt="">
										</div>
									</div><!--username-dt end-->
									<div class="user-specs">
										<h3></h3>
										<!-- Follow / Unfollow button -->
										<input type="hidden" id="profileUserId" class="setprofileUserId">
										<!--<input type="hidden" id="profileUserId" value="2">-->
										<button id="" class="btn-sm btn-primary followBtn"
											style="background:linear-gradient(135deg, #43cea2, #185a9d);border-radius:1px;">
											Loading...
										</button>

									</div>
								</div><!--user-profile end-->
								<ul class="user-fw-status">
									<li>
										<h4>Following</h4>
										<span class="following"></span>
									</li>
									<li>
										<h4>Followers</h4>
										<span class="followers"></span>
									</li>
									<li>
										<a href="#" title="" style="color: #185a9d;">View Profile</a>
									</li>
								</ul>
							</div><!--user-data end-->
						</div><!--main-left-sidebar end-->
					</div>
					<div class="col-lg-6 col-md-8 no-pd">
						<div class="main-ws-sec">
							<div class="post-topbar" style="border-top: 4px solid #43cea2;">
								<div class="user-picy">
									<img src="http://localhost:8000/images/lavi.jpg" alt="" style="border-radius: 30px;;">
								</div>
								<div class="post-st">
									<ul>
										<li><a class="post-jb active" href="#" title="" style="background: linear-gradient(135deg, #43cea2, #185a9d);
">Create Post</a></li>
									</ul>
								</div><!--post-st end-->
							</div><!--post-topbar end-->
							<div class="posts-section">
								<div id="postsContainer">Loading posts...</div>
							</div><!--posts-section end-->
						</div><!--main-ws-sec end-->
					</div>
					<div class="col-lg-3 pd-right-none no-pd">
						<div class="right-sidebar">
							<div class="widget suggestions full-width">
								<div class="sd-title">
									<h3>Most Viewed People</h3>
									<i class="la la-ellipsis-v"></i>
								</div><!--sd-title end-->
								<div class="suggestions-list">
									<div id="mostViewedList"></div>
								</div><!--suggestions-list end-->
							</div>
						</div><!--right-sidebar end-->

						<div class="right-sidebar">
  <div class="widget suggestions full-width">
    <div class="sd-title">
      <h3>Make Friends</h3>
      <i class="la la-ellipsis-v"></i>
    </div>
    <div class="users-list"><!-- users will load here --></div>
  </div>
</div>

					</div>
					
				</div>
			</div><!-- main-section-data end-->
		</div>
	</div>
</main>
<div class="post-popup job_post">
	<div class="post-project">
		<h3 style="background: linear-gradient(135deg, #43cea2, #185a9d);
">Create Post</h3>
		<div class="post-project-fields">
			<form id="createPostForm">
				<div class="row">
					<div class="col-lg-12">
						<input type="text" name="title" placeholder="Title" id="post_title">
					</div>
					<div class="col-lg-12">
						<textarea name="description" placeholder="Description" id="post_body"></textarea>
					</div>
					<input type="hidden" id="receiverId">
					<div class="col-lg-12">
						<ul>
							<li>
								<button type="button" class="active add_post" style="background: linear-gradient(135deg, #43cea2, #185a9d);">
									Create
								</button>
							</li>
						</ul>
					</div>
				</div>
			</form>
		</div><!--post-project-fields end-->
		<a href="#" title=""><i class="la la-times-circle-o"></i></a>
	</div><!--post-project end-->
</div><!--post-project-popup end-->
<footer>
	<div class="footy-sec mn no-margin">
		<div class="container">
			<ul>
				<li><a href="about.html" title="">About</a></li>
				<li><a href="#" title="">Privacy Policy</a></li>
			</ul>
			<p>Copyright 2025</p>
		</div>
	</div>
</footer>
</div><!--theme-layout end-->
@endsection