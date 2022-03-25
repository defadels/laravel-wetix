<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Movie $movies)
    {
        $q = $request->input('q');


        $active = "Movies";

        $movies = $movies->when($q, function($query) use ($q) {
                return $query->where('title','like', '%'.$q.'%')
                             ->orWhere('description','like', '%'.$q.'%');
                })
                ->paginate(10);


       
        return view('dashboard/movie/list', ['movies' => $movies, 'request' => $request, 'active' => $active]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Movie $movie)
    {
        $active = "Movies";

        return view('dashboard/movie/form', [
            'active' => $active,
            'movie' => $movie,
            'button' => 'Create',
            'url' => 'dashboard.movies.store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movie $movie)
    {

       $validate  = Validator::make($request->all(),[
            'title'       => 'required|unique:App\Models\Movie,title',
            'description' => 'required',
            'thumbnail'   => 'required|image',
       ]);

       if($validate->fails()){
           return redirect()
                    ->route('dashboard.movies.create')
                    ->withErrors($validate)
                    ->withInput();
       }else {
           $image = $request->file('thumbnail');
           $filename = time() . '.' . $image->getClientOriginalExtension();
           Storage::disk('local')->putFileAs('public/movies', $image, $filename);

           $movie->title = $request->input('title'); 
           $movie->description = $request->input('description');
           $movie->thumbnail = $filename;

           $movie->save(); 

           return redirect()
                    ->view('dashboard.movies');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $active = "Movies";

        return view('dashboard/movie/form', [
            'active' => $active, 
             'movie' => $movie,
            'button' => 'Update',
            'url' => 'dashboard.movies.update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $validate  = Validator::make($request->all(),[
            'title'       => 'required|unique:App\Models\Movie,title,'.$movie->id,
            'description' => 'required',
            'thumbnail'   => 'image',
       ]);

       if($validate->fails()){
           return redirect()
                    ->route('dashboard.movies.update', $movie->id)
                    ->withErrors($validate) 
                    ->withInput();
       }else {
           if($request->hasFile('thumbnail')){

               $image = $request->file('thumbnail');
               $filename = time() . '.' . $image->getClientOriginalExtension();
               Storage::disk('local')->putFileAs('public/movies', $image, $filename);
               $movie->thumbnail = $filename;
           }

           $movie->title = $request->input('title'); 
           $movie->description = $request->input('description');

           $movie->save(); 

           return redirect()
                    ->route('dashboard.movies');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
