<?php

namespace App\Http\Controllers;

use App\Models\Dentist;
use Illuminate\Http\Request;
use App\Http\Requests\Dentist\CreateDentistRequest;
use App\Http\Requests\Dentist\UpdateDentistRequest;

class DentistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dentist = Dentist::all();
        return response()->json($dentist);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDentistRequest $request)
    {
        $req = $request->all();
        $dentist = Dentist::create($req);
        return response()->json($dentist);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dentist  $dentist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Dentist::findOrFail($id);
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dentist  $dentist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDentistRequest $request)
    {
      //El update se haría directamente desde el usuario, dado que la información la obtenemos de ese modelo
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dentist  $dentist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dentist = Dentist::findOrFail($id);
        $dentist->delete();
        return response()->json(null,204);
    }
}
