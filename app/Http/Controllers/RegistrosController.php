<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Builder;
use App\Http\Resources\RegistrosCollection;
use App\Registros;

class RegistrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new RegistrosCollection(Registros::where('blacklist',false)->get());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $registro = new Registros([
            'label' => $request->get('label'),
            'numero' => $request->get('numero'),
            'blacklist' => false
        ]);
        $registro->save();
        return response()->json('Criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registro = Registros::find($id);
        return response()->json($registro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $registro = Registros::find($id);

        $registro->update($request->all());

        return response()->json('Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $registro = Registros::find($id);

        $registro->delete();

        return response()->json('Deletado com sucesso!');
    }

    public function blacklist()
    {
        return new RegistrosCollection(Registros::where('blacklist', true)->get());
    }

    public function addBlacklist($id)
    {
        $registro = Registros::find($id);
        $registro->blacklist = true;
        $registro->save();

        return response()->json('Adicionado a Blacklist!');
    }
    public function delBlacklist($id)
    {
        $registro = Registros::find($id);
        $registro->blacklist = false;
        $registro->save();

        return response()->json('Removido da Blacklist!');
    }
}
