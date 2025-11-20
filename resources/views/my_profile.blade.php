@extends('pages.layout')
@section('title', 'My Profile')
@section('content')

<style>
    .cover-sec {
        position: relative;
    }

    .cover-sec img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 5px;
    }

    .add-pic-box label {
        background: #ff5733;
        color: #fff;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        display: inline-block;
        margin-top: 10px;
    }

    #saveCoverBtn {
        display: none;
        background: #28a745;
        color: #fff;
        padding: 8px 16px;
        border-radius: 5px;
        margin-left: 10px;
        cursor: pointer;
        border: none;
    }
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

<section class="cover-sec">
    <img id="coverImage" alt="Cover Image">

    <!---@if($user->cover_photo)
    <img src="{{ asset($user->cover_photo) }}" alt="Cover Photo" width="200">
@else
    <p>No cover photo uploaded</p>
@endif-->

    <div class="add-pic-box">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-12 col-sm-12 text-center">
                    <form id="coverForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="coverInput" name="cover" accept="image/*" style="display:none" onchange="previewCover(event)">
                        <label for="coverInput">Change Image</label>
                        <button type="button" id="saveCoverBtn" onclick="saveCover()">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<main>
    <div class="main-section">
        <div class="container">
            <div class="main-section-data">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="main-left-sidebar">
                            <div class="user_profile">
                                <div class="user-pro-img">
                                    <img src="/{{ $user->profile_pic; }}" id="profileImage">
                                    <div class="add-dp" id="OpenImgUpload">
                                        <input type="file" id="file">
                                        <label for="file"><i class="fas fa-camera"></i></label>
                                    </div>
                                </div>
                                <div class="user_pro_status">
                                    <ul class="flw-status">
                                        <li><span>Following</span><b>{{ $user->following->count() }}</b></li>
                                        <li><span>Followers</span><b>{{ $user->followers->count() }}</b></li>

                                    </ul>
                                </div>
                                @if($user->socialLinks)
                                <ul class="social_links">

                                    <li><a href="{{ $user->socialLinks->site_link }}" title=""><i class="la la-globe"></i> {{ $user->socialLinks->site_link }}</a></li>
                                    <li><a href="{{ $user->socialLinks->face_link }}" title=""><i class="fa fa-facebook-square"></i> {{ $user->socialLinks->face_link }}</a></li>
                                    <li><a href="{{ $user->socialLinks->x_link }}" title=""><i class="fa fa-twitter"></i> {{ $user->socialLinks->x_link }}</a></li>
                                    <li><a href="{{ $user->socialLinks->insta_link }}" title=""><i class="fa fa-instagram"></i>{{ $user->socialLinks->insta_link }}</a></li>
                                </ul>
                                @else
                                <p>No social links available.</p>
                                @endif
                                <ul class="user-fw-status">

                                    <li>
                                        <a href="/edit-profile/{{ $user->id; }}" title="" style="color: #185a9d;">Edit Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="main-ws-sec">
                            <div class="product-feed-tab current" id="feed-dd">
                                <div class="posts-section">

                                    @if($user->posts->isEmpty())
                                    <div class="post-bar">
                                        <p>No posts available.</p>
                                    </div>
                                    @endif

                                    @foreach($user->posts as $post)

                                    <div class="post-bar">
                                        <div class="post_topbar">
                                            <div class="usy-dt">
                                                <img src="/{{ $user->profile_pic; }}" alt="" style="width:36px;height:36px;border-radius:50%;border:1px solid #3ab07f;margin-right:10px;">
                                                <div class="usy-name">
                                                    <h3>{{ $user->name; }}</h3>
                                                    <span><img src="https://gambolthemes.net/workwise-new/images/clock.png" alt="">3 min ago</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job_descp">
                                            <p>{{ $post->body }}</p>
                                        </div>
                                        <div class="job-status-bar">
                                            <ul class="like-com">
                                                <li><a href="#"><i class="fas fa-heart"></i> Like</a></li>
                                                <li><a href="#" class="com" style="top: 0px;"><i class="fas fa-comment-alt"></i> Comment 15</a></li>
                                                <div class="comments">
                                                    @foreach($post->comments as $comment)
                                                    <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->text }}</p>
                                                    @endforeach
                                                </div>
                                            </ul>

                                        </div>
                                    </div>

                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="suggestions full-width">
                        <div class="sd-title">
									<h3>Most Viewed People</h3>
									<i class="la la-ellipsis-v"></i>
								</div><!--sd-title end-->
								<div class="suggestions-list">
									<div id="mostViewedList"></div>
								</div><!--suggestions-list end-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

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

<script>
    function previewCover(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('coverImage').src = e.target.result;
                document.getElementById('saveCoverBtn').style.display = 'inline-block';
            };
            reader.readAsDataURL(file);
        }
    }

    function saveCover() {
        const formData = new FormData();
        formData.append('cover', document.getElementById('coverInput').files[0]);
        formData.append('_token', '{{ csrf_token() }}');

        const token = localStorage.getItem('token'); // assuming you stored the token


        $.ajax({
            url: "{{ route('upload.cover') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'Authorization': `Bearer ${token}`,
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    alert('Cover photo uploaded!');
                    $('#coverImage').attr('src', response.path);
                    $('#saveCoverBtn').hide();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Error uploading file.');
            }
        });
    }
</script>

@endsection