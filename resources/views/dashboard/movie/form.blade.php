@extends('layouts.dashboard')


@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">

            <div class="col-8 align-self-center">
                <h3>Movies</h3>
            </div>
            <div class="col-4 text-right">
                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                <i class="fas fa-trash"></i>    
                Delete</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 offset-md-2">
        <form method="post" action="{{ route($url, $movie->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{$movie->title}}">
                @error('title')
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description">{{$movie->description}}</textarea>
                @error('description')
                    <span class="text-danger">
                        {{ $message }}
                    </span>  

                @enderror
            </div>
            <div class="form-group mt-4">
                <div class="custom-file">
                    
                    <input type="file" class="custom-file-input" name="thumbnail">
                    <label for="thumbnail" class="custom-file-label">Thumbnail</label>
                    @error('thumbnail')
                        <span class="text-danger">
                            {{ $message }}
                        </span>

                    @enderror
                </div>
                
            </div>
            <div class="form-group mb-0">
                <button type="button" onclick="window.history.back()" class="btn btn-sm btn-secondary">Back</button>
                <button type="submit" class="btn btn-primary btn-sm">{{$button}}</button>
            </div>
        </form>
        </div>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Delete</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure to delete user named 
                </p>  
            </div>
            <div class="modal-footer">
                <form action="{{ route('dashboard.movies.delete') }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-sm btn-danger" type="submit">
                <i class="fas fa-trash"></i>    
                Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection