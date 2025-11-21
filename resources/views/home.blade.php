@extends('pages.layout')
@section('content')
<main>
	<style>
		/* --- Global Container Styles --- */
.suggestions-list {

    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
    padding: 15px;
}

#mostViewedList {
    display: flex;
    flex-direction: column;
    gap: 10px; 
}

/* --- Individual User Card Styles --- */
.viewed-user-card {
    display: flex;
    justify-content: space-between; 
    align-items: center;
    padding: 12px 15px;
    border-radius: 8px;
    background-color: #f9f9f9; 
    border: 1px solid #eeeeee; 
    transition: all 0.2s ease-in-out; 
}

/* Hover effect */
.viewed-user-card:hover {
    background-color: #f0f8ff;
    border-color: #3b82f6; 
    transform: translateY(-2px);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.05);
}

/* --- Typography Styles --- */
.viewed-user-card h4 {
    font-size: 16px;
    font-weight: 600;
    color: #333333; 
    margin: 0;
    flex-grow: 1;
}

.viewed-user-card p {
    font-size: 14px;
    font-weight: 500;
    color: #6b7280; 
    margin: 0;
   
    text-align: right;
    min-width: 90px; 
}

/* Responsive adjustments for smaller screens */
@media (max-width: 600px) {
    .viewed-user-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    .viewed-user-card p {
        text-align: left;
    }
}
	</style>
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
											<img 
											 src="{{ auth()->user()->profile_pic ? auth()->user()->profile_pic : 'https://placehold.co/50x50/e0e0e0/505050?text=Default' }}"
											 alt="">

											 
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
										<a href="profile-detail/{{ auth()->user()->id }}" title="" style="color: #185a9d;">View Profile</a>
									</li>
								</ul>
							</div><!--user-data end-->
						</div><!--main-left-sidebar end-->
					</div>
					<div class="col-lg-6 col-md-8 no-pd">
						<div class="main-ws-sec">
							<div class="post-topbar" style="border-top: 4px solid #43cea2;">
								<div class="user-picy">
									<img src="{{ auth()->user()->profile_pic }}" alt="" style="border-radius: 30px;">
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