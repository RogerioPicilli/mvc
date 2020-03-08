<?php

namespace LaraDev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaraDev\Property;

class PropertyController extends Controller
{
    public function index()
    {
        // $properties = DB::select("SELECT * FROM properties");
        $properties = Property::all(); 
        // var_dump($properties);

        return view('property.index')->with('properties', $properties);
    }

    public function show($uri)
    {
        // $property = DB::select("SELECT * FROM properties WHERE uri = ?", [$uri] );
        $property = Property::where('uri', $uri)->get();

        if (!empty($property)) {
            return view('property.show')->with('property', $property);
        } else {
            return redirect()->action('PropertyController@index');
        }
    }

    public function create()
    {
        return view('property.create');
    }

    public function store(Request $request)
    {
        $uri = $this->setUri($request->title);

        // $property = [
        //     $request->title,
        //     $uri,
        //     $request->description,
        //     $request->rental_price,
        //     $request->sale_price
        // ];
        // DB::insert("INSERT INTO properties (title, uri, description, rental_price, sale_price) VALUES
        //                                 (?, ?, ?, ?, ?)", $property);

        $property = [
            'title' => $request->title,
            'uri' => $uri,
            'description' => $request->description,
            'rental_price' => $request->rental_price,
            'sale_price' => $request->sale_price
        ];

        Property::create($property);

        return redirect()->action('PropertyController@index');
    }

    public function edit($uri)
    {
        // $property = DB::select("SELECT * FROM properties WHERE uri = ?", [$uri] );
        $property = Property::where('uri', $uri)->get();

        if (!empty($property)) {
            return view('property.edit')->with('property', $property);
        } else {
            return redirect()->action('PropertyController@index');
        }
    }

    public function update(Request $request, $id)
    {
        $uri = $this->setUri($request->title);

        // $property = [
        //     $request->title,
        //     $uri,
        //     $request->description,
        //     $request->rental_price,
        //     $request->sale_price,
        //     $id
        // ];
        // DB::update("UPDATE properties set title = ?, uri = ?, 
        //             description = ?, rental_price = ?, sale_price = ?
        //             where id = ?", $property);

        $property = Property::find($id);

        $property->title = $request->title;
        $property->uri = $uri;
        $property->description = $request->description;
        $property->rental_price = $request->rental_price;
        $property->sale_price = $request->sale_price;
        
        $property->save();


        return redirect()->action('PropertyController@index');

    }

    public function destroy($uri)
    {
        // $property = DB::select("SELECT * FROM properties WHERE uri = ?", [$uri] );
        $property = Property::where('uri', $uri)->get();

        if (!empty($property)) {
            DB::delete("DELETE FROM properties WHERE uri = ?", [$uri]);
        }
        return redirect()->action('PropertyController@index');
    }

    private function setUri($title)
    {
        //Esta variavel será a uri amigavel sem espaço, acento, tudo minusculo, etc...
        $propertySlug = str_slug($title);
        // $properties = DB::select("SELECT * FROM properties");
        $properties = Property::all();

        $t = 0;
        foreach ($properties as $property) {
            if (str_slug($property->title) === $propertySlug) {
                $t++;
            }
        }

        if ($t > 0) {
            $propertySlug = $propertySlug . '-' . $t;
        }

        return $propertySlug;

    }


}
