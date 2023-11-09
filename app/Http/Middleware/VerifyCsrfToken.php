<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        "/roles/*",
        "/users/",
        "/users/*",
        "/horarios/",
        "/veterinarios/",
        "/veterinarios/*",
        "/clientes/",
        "/clientes/*",
        "/mascotas/",
        "/mascotas/*",
        "/razas/",
        "/razas/*",
        "/animales/",
        "/citas/",
        "/citas/*",
        "/tipocitas/",
        "/tipocitas/*",
        "/especialidades/",


    ];
}
