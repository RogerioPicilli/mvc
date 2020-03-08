<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class checkParam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // SEM PARAMETRO NO HANDLE
    // public function handle($request, Closure $next)
    // {
    //     // Log::info("Foi invocado o meu primeiro middleware");
    //     // //caso os checks acima permitam o metodo que foi originalmente requisitado será executado abaixo.
    //     // Log::info("TESTE 1");
        
    //     // return $next($request);

    //     //Agora com processo antes e depois
    //     Log::info("Foi invocado o meu primeiro middleware");
    //     //caso os checks acima permitam o metodo que foi originalmente requisitado será executado abaixo.
    //     Log::info("TESTE 1");

    //     $qqvar = $next($request);

    //     Log::info("TESTE 3");

    //     return $qqvar;
    // }

    // COM PARAMETRO NO HANDLE
    public function handle($request, Closure $next, $parametro, $parametroN)
    {
        //EXEMPLO DE UMA REGRA FICTICIA

        // Pega o user que está logado
        // Verifica o parametro, por exemplo 'admin"
        // if (attr == param) ? next(request) : redirect(login)

        // Log::info("Foi invocado o meu primeiro middleware");
        // //caso os checks acima permitam o metodo que foi originalmente requisitado será executado abaixo.
        // Log::info("TESTE 1");
        
        // return $next($request);

        //Agora com processo antes e depois
        Log::info('Foi invocado o meu primeiro middleware [' . $parametro . ' - ' . $parametroN . ']');
        //caso os checks acima permitam o metodo que foi originalmente requisitado será executado abaixo.
        Log::info("TESTE 1");

        $qqvar = $next($request);

        Log::info("TESTE 3");

        return $qqvar;
    }
}
