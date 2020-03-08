<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        // $users = DB::table('users')
        //     ->select('users.id', 'users.name', 'users.status')
        //     ->where('users.status','=', 1)
        //     ->orderBy('users.name', 'ASC' )
        //     //->oldest()  //Pega a coluna created_at ASC
        //     //->oldest('users.name')
        //     //->latest()  //Pega a coluna created_at DESC
        //     //->lastes('users.name')
        //     //->inRandomOrder('users.name')  Bom quando se quer mostrar artigos em ordem aleatória
        //     ->limit(10)  //pega 10 registros
        //     ->offset(10) //a partir do registro 10
        //     ->get();

        // foreach ($users as $user) {
        //     echo "#{$user->id} Nome: {$user->name} Status: {$user->status}<br>";
        // }

        // $users = DB::table('users')
        //     ->selectRaw('users.id, users.name, CASE WHEN users.status = 1 THEN "Ativo" ELSE "Inativo" END statusEscrito')
        //     ->whereRaw('(SELECT COUNT(1) FROM addresses a WHERE a.user = users.id) > 2')  //usuarios com mais do que 2 endereços
        //     ->whereRaw('users.status = 1')  //e que sejam ativo
        //     ->orderByRaw('updated_at - created_at', 'ASC')
        //     ->get();

        // foreach ($users as $user) {
        //     echo "#{$user->id} Nome: {$user->name} Status: {$user->statusEscrito}<br>";
        // }

        /**
         * Metodo bruto de pesquisa
         */

        // $users = DB::Select(DB::raw('SELECT users.id, users.name, 
        //                                CASE 
        //                                   WHEN users.status = 1 THEN "Ativo" 
        //                                   ELSE "Inativo" 
        //                                 END status
        //                                 FROM USERS
        //                                 WHERE (SELECT COUNT(1) FROM addresses a WHERE a.user = users.id) > 2
        //                                     AND users.status = :userStatus
        //                                 ORDER BY updated_at - created_at ASC;'), ['userStatus' => 1]);

        // foreach ($users as $user) {
        //     echo "#{$user->id} Nome: {$user->name} Status: {$user->status}<br>";
        // }

        /**
         * CHUNK para pesquisas muito grande
         * pode usar um orderby ou mesmo o chunkById    ou    ->orderBy('colunam')->chunk(100)
         */

        // DB::table('users')->where('id', '<', '500')
        //       ->chunkById(100, function($users){
        //         foreach ($users as $user) {
        //             echo "#{$user->id} Nome: {$user->name} Status: {$user->status}<br>";
        //         }
        //       });

/*
         *ParseString
         */
        // $users = DB::table('users')
        //     ->whereIn('users.status', [0, 1])
        //     // ->whereNotIn('users.status', [0, 1])
        //     // ->whereNull()
        //     // ->whereNotNull()
        //     // ->whereColumn('created_at', '=', 'updated_at')
        //     // ->whereDate('created_at', '>', '2020-03-15 17:30:00')
        //     // ->whereDay('created_at', '=', '15')
        //     // ->whereMonth('created_at', '=', '03')
        //     // ->whereYear('created_at', '=', '2020')
        //     // ->whereTime('created_at', '>=', '17:30:00')
        //     ->get();
        // foreach ($users as $user) {
        //     echo "#{$user->id} Nome: {$user->name} Status: {$user->status}<br>";
        // }

/*
* Trabalhando com Join
*/

        // $users = DB::table('users')
        //     ->select('users.id', 'users.name', 'users.status', 'addresses.address')
        //     // ->leftJoin('addresses', 'users.id', '=', 'addresses.user')
        //     ->join('addresses', function($join){
        //         $join->on('users.id', '=', 'addresses.user')
        //              ->where('addresses.status', '=', '1');
        //     })
        //     ->orderBy('users.id', 'ASC')
        //     ->get();
        // echo "<br>";
        // echo "Total de registros {$users->count()}<br>";
        // foreach ($users as $user) {
        //     echo "#{$user->id} Nome: {$user->name} Status: {$user->status} {$user->address}<br>";
        // }

/**
 * CRUD AVANÇADO
 */
        //Inserir
        // DB::table('users')->insert([
        //     'name' => 'Rogério Picilli',
        //     'email' => 'rogerio@docs.com.br',
        //     'password' => bcrypt('Docs2013@'),
        //     'status' => 1
        // ]);

        //update
        // DB::table('users')->where('id', 1001)
        //     ->update([
        //     'email' => 'rogeriopicilli@docs.com.br'
        // ]);

        //delete
        // DB::table('users')->where('id', 1001)
        // ->delete();

        
/**
 * Paginação
 */

        // METODO SIMPLES COM NEXT E PREVIOUS
        // $users = DB::table('users')->simplePaginate(50);

        // foreach ($users as $user) {
        //     echo "#{$user->id} Nome: {$user->name} Status: {$user->status}<br>";
        // }

        // echo $users->links();

        //METODO COMPLETO
        $users = DB::table('users')->Paginate(50);

        foreach ($users as $user) {
            echo "#{$user->id} Nome: {$user->name} Status: {$user->status}<br>";
        }

        echo $users->links();

    }
}