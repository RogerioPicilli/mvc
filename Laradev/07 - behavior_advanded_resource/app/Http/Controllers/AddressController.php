<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::find($id);

        echo "<h1>Endereço de Entrega</h1><br>";
        echo "Endereço   : {$address->address}, Nº {$address->number} <br>";
        echo "Complemento: {$address->complement}, Cep: {$address->zipcode}<br>";
        echo "Cidade     : {$address->city}, Estado: {$address->state}<br>";

        echo "<h1>Dados do Usuário</h1><br>";
        $addressUser = $address->user()->get()->first();
        echo "Nome do usuário : {$addressUser->name}<br>";
        echo "Email do usuário: {$addressUser->email}<hr>";

        echo "Tentando direto: {$address->user()->first()->name}<br> ";
        echo "Tentando direto: {$address->user()->first()->email}<hr> ";


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
