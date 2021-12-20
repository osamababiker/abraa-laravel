<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/suppliers/filter',
        '/items/filter',
        '/stores/filter',
        '/rfq/filter',
        '/categories/filter',
        '/buyers/filter',
        '/shippers/filter'
    ];
}
 