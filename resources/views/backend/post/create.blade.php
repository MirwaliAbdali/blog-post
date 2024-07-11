@extends('backend.layout.master')

@section('content')

  <div class="card col-md-8 mx-auto">
    <h4 class="card-header mx-auto">
      Create Post
    </h4>

    <div class="card-body">

      <form action="">
      
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" class="form-control" placeholder="Enter post title">
        </div>
      
        <div class="form-group">
          <label for="sub_title">Sub Title</label>
          <input type="text" name="sub_title" class="form-control" placeholder="Enter post sub title">
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" cols="30" rows="5" class="form-control my-editor" placeholder="Enter post description"></textarea>
        </div>

        <button class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>

@endsection