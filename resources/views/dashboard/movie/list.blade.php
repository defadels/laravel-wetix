@extends('layouts.dashboard')


@section('content')
<div class="mb-2">
    <a href="{{route('dashboard.movies.create')}}" class="btn btn-primary btn-sm">+ Movie</a>
</div>
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

        @if($movies->total())
        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>&nbsp;</th>
                </tr> 
            </thead> 
        <tbody>
            @foreach($movies as $movie) 
                <tr>
                    {{-- <th scope="row">{{ ($movies->currentPage() - 1) * $movies->perPage() + $loop->iteration }}</th> --}}
                    <td class="col-thumbnail">
                        <img src="{{ asset('storage/movies/'.$movie->thumbnail) }}" class="img-fluid" alt="{{$movie->description}}" srcset="">
                    </td>
                    <td>
                       <h4><strong>{{$movie->title}}</strong></h4> </td>
                    <td><a href="{{route('dashboard.movies.edit',$movie->id)}}" title="Edit data" class="btn btn-success btn-sm">
                    <i class="fas fa-pen"></i></a></td>
                </tr>  
            @endforeach
        </tbody>
        
    </table>
    {{$movies->links()}}
    @else
        <h4 class="text-center p-3">Belum ada data movie</h4>
    @endif    
    </div>
</div>
    
@endsection