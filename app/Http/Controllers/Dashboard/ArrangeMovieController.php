<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ArrangeMovie;
use App\Models\Theater;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArrangeMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ArrangeMovie $arranges, Theater $theater)
    {
        $q = $request->input('q');


        $active = "Theaters";

        $arranges = $arranges->when($q, function($query) use ($q) {
                return $query->where('seats','like', '%'.$q.'%')
                             ->orWhere('price','like', '%'.$q.'%');
                })
                ->paginate(10);


       
        return view('dashboard/arrange_movie/list', ['arranges' => $arranges, 'request' => $request, 'active' => $active, 'theater' => $theater]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Theater $theater)
    {
        $active = "Theaters";

        $movies = Movie::get();

        return view('dashboard/arrange_movie/form', [
            'active'    => $active,
            'theater'   => $theater,
            'movies'    => $movies,
            'button'    => 'Create',
            'url'       => 'dashboard.theaters.arrange.movie.store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'studio' => 'required|max:250',
            'movie_id' => 'required',
            'price' => 'required',
            'rows' => 'required',
            'columns' => 'required',
            'schedule' => 'required',
            'status' => 'required'
        ]);

        if($validate->fails()){
            return redirect()->route('dashboard.theaters.arrange.movie.create', $request->input('theater_id'))->withErrors($validate)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function show(ArrangeMovie $arrangeMovie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function edit(ArrangeMovie $arrangeMovie)
    {
        $active = "Theaters";

        $movies = Movie::get();

        return view('dashboard/arrange_movie/form', [
            'active'    => $active,
            'theater'   => $theater,
            'movies'    => $movies,
            'arrangeMovie' => $arrangeMovie,
            'button'    => 'Update',
            'url'       => 'dashboard.theaters.arrange.movie.update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArrangeMovie $arrangeMovie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArrangeMovie $arrangeMovie)
    {
        //
    }
}
