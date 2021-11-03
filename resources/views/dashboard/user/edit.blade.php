@extends('layouts.dashboard')


@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">

            <div class="col-8 align-self-center">
                <h3>Users</h3>
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
        <form method="post" action="{{ url('dashboard/user/update/'.$user->id) }}" >
        @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                @error('nama')
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') ?? $user->email }}">
                @error('email')
                    <span class="text-danger">
                        {{ $message }}
                    </span>

                @enderror
            </div>
            <div class="form-group mb-0">
                <button type="button" onclick="window.history.back()" class="btn btn-sm btn-secondary">Back</button>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
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
            </div>
            <div class="modal-body">
                <p>
                    Are you sure to delete user named {{$user->name}}
                </p>  
            </div>
            <div class="modal-footer">
                <form action="{{ url('/dashboard/user/delete/'.$user->id) }}" method="post">
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