@extends('layouts.dashboard')


@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">

            <div class="col-8 align-self-center">
                <h3>Users</h3>
            </div>
            <div class="col-4">
                <form method="get" action="{{ url('dashboard/users') }}">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control form-control-sm" value="{{ $req['q'] ?? '' }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-secondary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Regitered</th>
                    <th>Edited</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td><a href="{{route('dashboard.users.edit',$user->id)}}" title="Edit data" class="btn btn-success btn-sm">
                    <i class="fas fa-pen"></i></a></td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
    {{$users->links()}}
    </div>
</div>
    
@endsection