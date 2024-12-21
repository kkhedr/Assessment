@extends('master')

@section('title', 'Create Blog')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Update Blog</h4>
      <form action="{{ route('blogs.update', $blog->id) }}" method="post" class="forms-sample" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="title">title</label>
          <input type="text" class="form-control" id="title" name="title" required maxlength="255" value="{{ $blog->title }}">
        </div>

        <div class="form-group">
          <label for="slug">slug</label>
          <input type="text" class="form-control" id="slug" name="slug" required maxlength="255" value="{{ $blog->slug }}">
        </div>

        <div class="form-group">
          <label for="content">content</label>
          <textarea required name="content" rows="4" cols="50">{{ $blog->content }}</textarea>
        </div>

        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <img src="{{$blog->image_path}}" height="300px" width="300px">

        <button type="submit" class="btn btn-primary me-2">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection

