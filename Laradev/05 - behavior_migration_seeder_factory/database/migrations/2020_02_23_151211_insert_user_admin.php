<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertUserAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $email = env('ADMIN_EMAIL', 'admin@admim.com.br'); //O segundo parâmetro estou colocando só pra saber que existe. Não usar
        $pass = bcrypt(env('ADMIN_PASS'));
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => $email,
            'password' => $pass            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $email = env('ADMIN_EMAIL');
        DB::delete('DELETE FROM users WHERE email = ?', [$email]);
    }
}
