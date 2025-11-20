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
                        <!-- Display Session Messages (Success/Error) -->
                        @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif

                        <!-- Display All Errors at the Top (Optional but helpful) -->
                        @if ($errors->any())
                        <div class="alert alert-danger" style="color:red; margin-bottom: 20px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
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
                            <input type="submit" name="Update" value="submit" class="btn btn-primary">
                        </form>
                        <br>
                    </div>
                </div>
            </div>
            <div class="main-section-data" style="padding: 12px;
    background-color: white;
    border: 1px solid #80808070; margin-top:20px">
                <div class="row">
                    <h1 style="    font-weight: 600;
    font-size: x-large;
    margin-bottom: 3%;">Update Password</h1>
                    <div class="col-lg-12">
                        <form action="{{route('update.password', $user_detail->id)}}" method="post">
                            @csrf
                            @method('PUT')

                            <!-- Display All Errors at the Top (Optional but helpful) -->
                            @if ($errors->passwordUpdate->any())
                            <div class="alert alert-danger" style="color:red; margin-bottom: 20px;">
                                <ul>
                                    @foreach ($errors->passwordUpdate->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif


                            <!-- ... Name and Email fields ... -->

                            <!-- Current Password Field -->
                            <label for="current_password" style="margin-bottom: 10px;">Enter your current password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="current_password" id="passwordInput" placeholder="Enter Current Password">
                                <!-- Toggle button remains here -->
                            </div>
                            @error('current_password')
                            <p style="color:red; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                            <br>
                            <!-- New Password Field -->
                            <div class="form-group">
                                <label for="password" style="margin-bottom: 10px;">New Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password')
                                <p style="color:red; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="form-group">
                                <label for="confirm_password" style="margin-bottom: 10px;">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="confirm_password" class="form-control">
                                <!-- The 'confirmed' rule uses the name of the confirmation field -->
                                @error('confirm_password')
                                <p style="color:red; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <input type="submit" name="Update" value="submit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>



        </div>
    </div>

    @endsection