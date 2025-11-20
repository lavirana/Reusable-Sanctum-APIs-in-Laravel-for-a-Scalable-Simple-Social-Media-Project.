@extends('pages.layout')
@section('title', 'My Profile')
@section('content')


<main>
    <div class="main-section">
        <div class="container">

            <div class="main-section-data" style="padding: 12px;
    background-color: white;
    border: 1px solid #80808070;">
                <div class="row">
                    <h1 style="    font-weight: 600;
    font-size: x-large;
    margin-bottom: 3%;">Edit Profile</h1>
                    <div class="col-lg-12">

                        <form action={{route('update.profile', $user_detail->id)}} method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" style="margin-bottom: 10px;">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ ucfirst($user_detail->name); }}">
                            </div>
                            <div class="form-group">
                                <label for="email" style="margin-bottom: 10px;">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user_detail->email; }}" readonly>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <label for="email" style="margin-bottom: 10px;">Enter your current password</label>
                            <div class="input-group">  
                                <input type="password" class="form-control" id="passwordInput" placeholder="Enter Password">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fa fa-eye-slash" id="toggleIcon"></i> <!-- Using Bootstrap Icons -->
                                    <!-- Or use Font Awesome: <i class="fa fa-eye-slash" id="toggleIcon"></i> -->
                                </button>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password" style="margin-bottom: 10px;">New Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" style="margin-bottom: 10px;">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                            </div>
                            <input type="submit" name="Update" class="btn btn-primary">
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

