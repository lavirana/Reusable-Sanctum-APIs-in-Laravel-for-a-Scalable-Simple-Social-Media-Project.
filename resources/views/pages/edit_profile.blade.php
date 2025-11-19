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
                    
                        <form action="">
                            <div class="form-group">
                                <label for="name" style="margin-bottom: 10px;">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" style="margin-bottom: 10px;">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="current_password" style="margin-bottom: 10px;">Current Password</label>
                                <input type="password" name="current_password" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" style="margin-bottom: 10px;">New Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" style="margin-bottom: 10px;">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                            </div>
                            <input type="submit" name="Submit" class="btn btn-primary">
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection