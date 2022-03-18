@extends('layouts.dashboard')


@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">

            <div class="col-8 align-self-center">
                <h3>Movies</h3>
            </div>
            <div class="col-4">
                <form method="get" action="{{ url('dashboard/movies') }}">
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
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
        <tbody>
            @foreach($movies as $movie)
                <tr>
                    <th scope="row">{{ ($movies->currentPage() - 1) * $movies->perPage() + $loop->iteration }}</th>
                    <td>{{$movie->title}}</td>
                    <td>{{$movie->thumbnail}}</td>
                    <td><a href="{{route('dashboard.movies.edit',$movie->id)}}" title="Edit data" class="btn btn-success btn-sm">
                    <i class="fas fa-pen"></i></a></td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
    {{$movies->links()}}
    </div>
</div>
    
@endsection