<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Signup Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/line-awesome.css">
    <link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/line-awesome-font-awesome.min.css">
    <link href="https://gambolthemes.net/workwise-new/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://gambolthemes.net/workwise-new/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
       .profile-card {
            max-width: 400px;
            width: 100%;
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        /* Hide the default file input */
        #profile_picture_input {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }
        .image-container {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #3b82f6; /* Blue border */
            transition: border-color 0.3s;
        }
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .upload-button-label {
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .upload-button-label:hover {
            background-color: #1e40af;
        }
</style>
<body class="sign-in" style="background: linear-gradient(135deg, #43cea2, #185a9d)">
    <div class="wrapper">
        <div class="sign-in-page">
            <div class="signin-popup">
                <div class="signin-pop">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-sec">
                                <div class="sign_in_sec current" id="tab-1">
                                    <h3>Signup</h3>
                                    <div id="loginError" style="color:red;display:none;margin-bottom:10px"></div>

                                    <form id="signupForm">
                                        <div class="row">


                                            <div class="col-lg-12 no-pdd" style="margin-left: 41%;
    margin-bottom: 20px;">
                                                <div class="image-container mb-4" id="imageContainer">
                                                    <!-- Default/Current Profile Image -->
                                                    <img
                                                        id="profilePreview"
                                                        src="https://placehold.co/150x150/e0e0e0/505050?text=Default"   
                                                        alt="Profile Picture"
                                                        onerror="this.onerror=null; this.src='https://placehold.co/150x150/e0e0e0/505050?text=Default';">
                                                </div>
                                                <!-- Hidden File Input -->
                                                <input
                                                    type="file"
                                                    name="profile_pic"
                                                    id="profile_picture_input"
                                                    accept="image/*"
                                                    onchange="previewImage(event)">

                                                <!-- Custom Button to Trigger File Input -->
                                                <label
                                                    for="profile_picture_input"
                                                    class="upload-button-label bg-blue-600 text-white font-semibold py-2 px-4 rounded-full shadow-lg hover:shadow-xl transition duration-300" style="background-color: blue;">
                                                    Choose New Photo
                                                </label>
                                            </div>

                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="name" name="name" id="name" placeholder="Name" required>
                                                    <i class="la la-user"></i>
                                                </div><!--sn-field end-->
                                            </div>

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
                                                <div class="sn-field">
                                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>

                                                    <i class="la la-lock"></i>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 no-pdd">
                                                <button type="submit" value="submit" style="background: linear-gradient(135deg, #43cea2, #185a9d)">Signup</button>
                                            </div>
                                        </div>
                                    </form>
                                </div><!--sign_in_sec end-->
                            
                            </div><!--login-sec end-->
                        </div>
                    </div>
                </div><!--signin-pop end-->
            </div><!--signin-popup end-->
        </div><!--sign-in-page end-->
    </div><!--theme-layout end-->
    <script type="text/javascript" src="https://gambolthemes.net/workwise-new/js/jquery.min.js"></script>
    <script type="text/javascript" src="https://gambolthemes.net/workwise-new/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://gambolthemes.net/workwise-new/js/script.js"></script>
    <script>
        // JavaScript function to display the image preview
        function previewImage(event) {
            const file = event.target.files[0];
            const previewElement = document.getElementById('profilePreview');
            const fileInput = document.getElementById('profile_picture_input');
            const imageContainer = document.getElementById('imageContainer');

            if (file) {
                // Check if the file is an image
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file (jpg, png, gif, etc.).');
                    fileInput.value = ''; // Clear the input
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Update the image source with the selected file data
                    previewElement.src = e.target.result;
                    // Optional: Change border color to show selection
                    imageContainer.style.borderColor = '#10b981'; // Green color
                };
                
                reader.readAsDataURL(file);
            } else {
                // If the user cancels the selection, reset to default placeholder
                previewElement.src = "https://placehold.co/150x150/e0e0e0/505050?text=Current+Image";
                imageContainer.style.borderColor = '#3b82f6'; // Reset border color
            }
        }
        
        // Ensure form enctype is correctly set (already in HTML, but good practice)
       //document.getElementById('profileForm').enctype = 'multipart/form-data';
    </script>

    <script>
        $(document).ready(function(){
            $('#signupForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
               $.ajax ({
                    url: '/api/v1/register',
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Handle success response
                        alert('Registration successful!');
                        window.location.href = "/login";
                    },
                    error: function(xhr) {
                        // Handle error response
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '<br>';
                        });
                        $('#loginError').html(errorMessages).show();
                    }
               });
            });
        });
    </script>
</body>

</html>