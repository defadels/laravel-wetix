@extends('layouts.dashboard')


@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">

            <div class="col-8 align-self-center">
                <h3>Theaters</h3>
            </div>
            @if(isset($theater))
            <div class="col-4 text-right">
                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                <i class="fas fa-trash"></i>    
                Delete</button>
            </div>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 offset-md-2">
        <form method="post" action="{{ route($url, $theater->id ?? '') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($theater))
            @method('put')
        @endif
        <input type="hidden" name="theater_id" id="" value="{{ $theater->id }}" class="form-control">

        <div class="form-group">
            <label for="movie_id">Movie</label>
            <select name="movie_id" id="" class="form-control">
              @if(count($movies) > 0)  
                <option value="">Select Movie</option>
                @foreach($movies as $movie)
                <option value="{{$movie->id}}">{{$movie->title}}</option>
                @endforeach

                @else
                <option value="">Movie Empty</option>
                
              @endif  
            </select>
        </div>

            <div class="form-group">
                <label for="theater">Studio</label>
                <input type="text" class="form-control @error('studio') {{'is-invalid'}} @enderror" name="studio" value="{{ old('studio') ?? $theater->theater ?? ''}}">
                @error('studio')
                <span class="text-danger"> 
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="theater">Price</label>
                <input type="number" class="form-control @error('price') {{'is-invalid'}} @enderror" name="price" value="{{ old('price') ?? $theater->theater ?? ''}}">
                @error('price')
                <span class="text-danger"> 
                    {{ $message }}
                </span>
                @enderror
            </div>
            
            <div class="form-group form-row mt-4">
                    <div class="col-2 align-self-center">
                        <label for="theater">Seats</label>
                    </div>
                    <div class="col-5">
                        <input type="number" placeholder="Rows" class="form-control @error('rows') {{'is-invalid'}} @enderror" name="rows" value="{{ old('rows') ?? $theater->theater ?? ''}}">
                        
                        @error('rows')
                        <span class="text-danger"> 
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-5">
                        <input type="number" placeholder="Cloumns" class="form-control @error('columns') {{'is-invalid'}} @enderror" name="columns" value="{{ old('columns') ?? $theater->theater ?? ''}}">
                        
                        @error('columns')
                        <span class="text-danger"> 
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
               
            </div>


        <div class="form-group mb-0">

            <label for="schedule">Schedule</label>  
        </div>
          <div class="card">
            <div class="card-body">
                <schedule-component></schedule-component>
            </div>    
        </div>  

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control @error('address') {{'is-invalid'}} @enderror" name="address">{{ old('address') ?? $theater->address ?? ''}}</textarea>
                @error('address')
                    <span class="text-danger">
                        {{ $message }}
                    </span>  

                @enderror
            </div>

                <div class="form-group mb-2">
                    <label for="status">Status</label>
                </div>    
                <div class="form-check form-check-inline">
                    <input type="radio" value="coming soon" name="status" class="form-check-input" id="coming soon" @if((old('status') ?? $theater->status ?? '') == 'coming soon') checked @endif>
                    <label for="coming soon" class="form-check-label">Coming Soon</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" value="in theater" name="status" class="form-check-input" id="in theater" @if((old('status') ?? $theater->status ?? '') == 'in theater') checked @endif>
                    <label for="in theater" class="form-check-label">In Theater</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" value="finish" name="status" class="form-check-input" id="finish" @if((old('status') ?? $theater->status ?? '') == 'finish') checked @endif>
                    <label for="finish" class="form-check-label">Finish</label>
                </div>
                <div>


                    @error('status')
                    <span class="text-danger">
                        {{$message}}
                    </span>
                    @enderror
            </div>
            
               
            
                
           
            <div class="form-group mt-2">
                <button type="button" onclick="window.history.back()" class="btn btn-sm btn-secondary">Back</button>
                <button type="submit" class="btn btn-primary btn-sm">{{$button}}</button>
            </div>
        </form>
        </div>
        </div>
    </div>
</div>

@if(isset($theater))
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
                    Are you sure to delete theater data 
                </p>  
            </div>
            <div class="modal-footer">
                <form action="{{ route('dashboard.theaters.delete', $theater->id ?? '') }}" method="post">
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
@endif
    
@endsection