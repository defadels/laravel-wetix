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
    public function index(Request $request, Theater $theater)
    {
        $q = $request->input('q');


        $active = "Theaters";

        $arranges = ArrangeMovie::where('theater_id', $theater->id)
                    ->whereHas('movies', function($query) use ($q){
                        $query->where('title', 'like', "%$q%");
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

            'studio'        => 'required',
            'theater_id'    => 'required',
            'movie_id'      => 'required',
            'status'        => 'required'
        ]);

        if($validate->fails()){

            return redirect()->route('dashboard.theaters.arrange.movie.create', $request->input('theater_id'))
            ->withErrors($validate)
            ->withInput();

        } else {

            $seats = [
                'rows' => $request->input('rows'),
                'columns' => $request->input('columns')
            ];

            $arrangemovie = new ArrangeMovie;

            $arrangemovie->movie_id     = $request->input('movie_id');
            $arrangemovie->theater_id   = $request->input('theater_id');
            $arrangemovie->studio       = $request->input('studio');
            $arrangemovie->price        = $request->input('price');
            $arrangemovie->status       = $request->input('status');
            $arrangemovie->seats        = json_encode($seats);
            $arrangemovie->schedules    = json_encode($request->input('schedules'));

            $arrangemovie->save();

            // dd($arrangemovie);

            return redirect()->route('dashboard.theaters.arrange.movie', $request->input('theater_id'))
            ->with('message', __('pesan.create', ['module' => $request->input('studio')]));

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
