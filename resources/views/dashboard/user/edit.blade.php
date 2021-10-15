@extends('layouts.dashboard')


@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">

            <div class="col-8">
                <h3>Users</h3>
            </div>
            <div class="col-4">
 
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="row">
            <div class="col-md-8 offset-md-2">
        <form action="{{url('dashboard/user/update'.%user->id)}}" method="post">
        @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-small">Update</button>
            </div>
        </form>
        </div>
        </div>
    </div>
</div>
    
@endsection