<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pais;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paises = DB::table('tb_pais')
            ->select('tb_pais.*')
            ->get();

        return json_encode(['paises' => $paises]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pais_nomb' => ['required',' max:255'],
        ]);

        if ($validated->fails()) {
            return response()->json([
                'msj' => 'Se produjo un error en la validaacion de la informacion.','statuscode' => 400
            ]);
        }

        $pais = new Pais();
        $pais->pais_codi = Str::upper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3));
        $pais->pais_nomb = $request->pais_nomb;
        $pais->pais_capi = $request->pais_capi;
        $pais->save();

        return json_encode(['pais' => $pais]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
