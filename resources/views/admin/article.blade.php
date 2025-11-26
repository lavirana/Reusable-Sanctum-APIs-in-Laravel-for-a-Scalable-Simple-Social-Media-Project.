@extends('pages.layout')
@section('content')


<div class="main-section">
    <div class="container">
        <div class="main-section-data" style="margin-top: 8%;">
            <div class="row">
                <div class="col-lg-12">
                    <form action="" style="padding: 15px;
    background-color: #fff;">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title">
                        <br>
                        <label for="body">Content</label>
                        <textarea name="body" id="body" class="form-control"></textarea>
                        <br>
                        <label for="status">Status</label>
                        <select name="" id="" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">In-Active</option>
                        </select>
                        <br>
                        <input type="submit" name="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection