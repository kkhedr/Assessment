@extends('master')

@section('title', 'blogs')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">    
                  <div class="card-body">
                  @if(auth()->user()->can('import-blog'))
                  <form action="{{ route('blogs.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required>
                    <button type="submit">Import Blogs</button>
                </form>
                @endif
                @if(auth()->user()->can('export-blog'))
                <a href="{{ route('blogs.export') }}" class="btn btn-success">Export Blogs</a>
                @endif
                  @if(auth()->user()->can('create-blog'))
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm">create</a>
                  @endif
                    <h4 class="card-title">blogs</h4>
                    
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>id</th>
                            <th>author</th>
                            <th>title</th>
                            <th>content</th>
                            <th>slug</th>
                            <th>image</th>
                            <th>actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($blogs as $blog)
                          <tr>
                          <td>{{ $blog->id }}</td>
                          <td>{{ $blog->author?->name }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->content }}</td>
                            <td>{{ $blog->slug }}</td>
                            <td> <img src="{{ $blog->image_path }}" height="200px" width="200px"> </td>
                            
                            <td>
                            @if(auth()->user()->can('edit-blog'))
                             <!-- Update button (Redirects to the edit page) -->
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary btn-sm">Update</a>
                            @endif

                            @if(auth()->user()->can('delete-blog'))
                            <!-- Delete form -->
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            @endif
                            </td> 
                          </tr>
                          @endforeach
                        
                        </tbody>
                      </table>
                      {{ $blogs->links() }}
                    </div>
                  </div>
                </div>
              </div>
@endsection

