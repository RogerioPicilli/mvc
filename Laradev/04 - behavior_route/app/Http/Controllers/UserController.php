<?php

namespace LaraDev\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() 
    {
        return "<h1>Lista do usuário de código 1</h1>";
    }

    public function getData() 
    {
        return "<h1>Disparou ação de GET</h1>";
    }

    public function postData() 
    {
        return "<h1>Disparou ação de POST</h1>";
    }

    public function testPut(Request $request) 
    {
        var_dump($request->all());
        return "<h1>Disparou ação de PUT</h1>";
    }

    public function testPatch(Request $request) 
    {
        var_dump($request->all());
        return "<h1>Disparou ação de PATCH</h1>";
    }

    public function testMatch(Request $request) 
    {
        var_dump($request->all());
        return "<h1>Disparou ação de PUT / PATCH</h1>";
    }
}
