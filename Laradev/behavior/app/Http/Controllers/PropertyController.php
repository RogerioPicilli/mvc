<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{

    public function middle() 
    {
        Log::info("TESTE 2");
        echo "Seja benvindo ao meu teste de middleware";
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('Properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //tabela do db
        $property = new Property();
        $property->title = $request->title;
        $property->rental_price = $request->rental_price;
        $property->cover = $request->file('cover')->store('properties');
        $property->save();

        //O que pode e alguns devem ser verificados quando de um upload de arquivo
        var_dump(
            $request->file('cover')->getMimeType,
            $request->file('cover')->getClientOriginalName(),
            $request->file('cover')->getClientOriginalExtension(),
            $request->file('cover')->getExtension(),
            $request->file('cover')->getSize(),
            $request->file('cover')->isValid()
        );

        echo "<img src='" . Storage::url($property->cover)  . "'>";

        //tres formas de pegar os dados do ou dos arquivo(s)
        // var_dump($request->cover, $request->file('cover'), $request->allFiles());
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
