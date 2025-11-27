@extends('pages.layout')
@section('content')


<div class="main-section">
    <div class="container">
        <div class="main-section-data" style="margin-top: 8%;background-color: #fff; padding:12px;">
            <div class="row">
                <div class="col-lg-12">
<strong>Create Article</strong>
<br>
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
                    
                    <form method="post" action="{{route('store-article')}}" style="padding: 15px;">
    @csrf
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title">
                        <br>
                        <label for="body">Content</label>
                        <textarea name="body" id="body" class="form-control"></textarea>
                        <br>
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">In-Active</option>
                        </select>
                        <br>
                        <label>Featured:</label>

                                <label>
                                    <input type="radio" name="featured" value="1"> Yes
                                </label>

                                <label>
                                    <input type="radio" name="featured" value="0"> No
                                </label>
<br>
<br>
                        <input type="submit" name="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection