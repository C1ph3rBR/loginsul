<?php


// app/Http/Middleware/VerifyCsrfToken.php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    // Remova ou comente essa propriedade para desabilitar completamente a verificação CSRF
    //protected $except = [];
}


?>