<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $municipios = DB::table('tb_municipio')
            ->join('tb_departamento', 'tb_municipio.depa_codi', '=', 'tb_departamento.depa_codi')
            ->select('tb_municipio.*', 'tb_departamento.depa_nomb')
            ->get();
            return json_encode(['municipios' => $municipios]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'muni_nomb' => ['required',' max:255'],
            'depa_codi' => ['required','numeric','min:1'],
        ]);

        if ($validated->fails()) {
            return response()->json([
                'msj' => 'Se produjo un error en la validaacion de la informacion.','statuscode' => 400
            ]);
        }

        $municipio = new Municipio();

        $municipio->muni_nomb = $request->muni_nomb;
        $municipio->depa_codi = $request->depa_codi;
        $municipio->save();

        return json_encode(['municipio' => $municipio]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $municipio = Municipio::find($id);
        if (is_null($municipio)) {
                return abort(404);
        }
        $departamentos = DB::table('tb_departamento')
            ->orderBy('depa_nomb')
            ->get();

        return json_encode(['municipio' => $municipio, 'departamentos' => $departamentos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'muni_nomb' => ['required',' max:255'],
            'depa_codi' => ['required','numeric','min:1'],
        ]);

        if ($validated->fails()) {
            return response()->json([
                'msj' => 'Se produjo un error en la validaacion de la informacion.','statuscode' => 400
            ]);
        }

        $municipio = Municipio::find($id);    
        if (is_null($municipio)) {
                return abort(404);
        }

        $municipio->muni_nomb = $request->name;
        $municipio->depa_codi = $request->code;
        $municipio->save();

        return json_encode(['municipio' => $municipio]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $municipio = Municipio::find($id);
        if (is_null($municipio)) {
                return abort(404);
        }
        
        $municipio->delete();

        $municipios = DB::table('tb_municipio')
        ->join('tb_departamento', 'tb_municipio.depa_codi', '=', 'tb_departamento.depa_codi')
        ->select('tb_municipio.*', 'tb_departamento.depa_nomb')
        ->get();

        return json_encode(['municipios' => $municipios, 'success' => true]);
    }
}
