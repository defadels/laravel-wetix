<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Theater;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TheaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Theater $theaters)
    {
        $q = $request->input('q');


        $active = "Theaters";

        $theaters = $theaters->when($q, function($query) use ($q) {
                return $query->where('title','like', '%'.$q.'%')
                             ->orWhere('description','like', '%'.$q.'%');
                })
                ->paginate(10);


       
        return view('dashboard/theater/list', ['theaters' => $theaters, 'request' => $request, 'active' => $active]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Theater $theater)
    {
        $active = "Theaters";

        return view('dashboard/theater/form', [
            'active' => $active,
            'button' => 'Create',
            'url' => 'dashboard.theaters.store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Theater $theater)
    {
        $validate = Validator::make($request->all(),[
            'theater' => 'required|max:250',
            'address' => 'required|max:300',
            'status' => 'required'
        ]);

        if($validate->fails()){
            return redirect()->route('dashboard.theaters.create')->withErrors($validate)->withInput();
        } else {
            $theater->theater = $request->input('theater');
            $theater->address = $request->input('address');
            $theater->status = $request->input('status');

            $theater->save();

            return redirect()->route('dashboard.theaters')->with('messages', __('pesan.create', ['module' => $request->input('theater')]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function show(Theater $theater)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function edit(Theater $theater)
    {
        $active = "Theaters";

        return view('dashboard/theater/form', [
            'active' => $active,
            'button' => 'Simpan',
            'theater' => $theater,
            'url' => 'dashboard.theaters.update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theater $theater)
    {
        $validate = Validator::make($request->all(),[
            'theater' => 'required|max:250',
            'address' => 'required|max:300',
            'status' => 'required'
        ]);

        if($validate->fails()){
            return redirect()->route('dashboard.theaters.create')->withErrors($validate)->withInput();
        } else {
            $theater->theater = $request->input('theater');
            $theater->address = $request->input('address');
            $theater->status = $request->input('status');

            $theater->save();

            return redirect()->route('dashboard.theaters')->with('messages', __('pesan.create', ['module' => $request->input('theater')]));
    }
}   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theater $theater)
    {
        
        $theater->delete();

        return redirect()->route('dashboard.theaters')
        ->with('messages',__('pesan.delete', ['module' => 'theater']));
    }
}
