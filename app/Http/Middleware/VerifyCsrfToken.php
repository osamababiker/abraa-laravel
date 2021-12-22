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
        '/rfqs/filter',
        '/categories/filter',
        '/buyers/filter',
        '/shippers/filter',
        '/homeSliders/filter',
        '/homeBanners/filter',
        '/adsCategories/filter',
        '/ads/filter',
        '/membershipsPlans/filter',
        '/membershipsTransactions/filter'
    ];
}
 