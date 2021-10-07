@extends('layouts.dashboard')


@section('content')
    <table class="table">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Regitered</th>
            <th>Edited</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>1</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
        </tr>
        @endforeach
    </table>
@endsection