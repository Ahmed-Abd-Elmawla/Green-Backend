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
        // '/dashboard/users/update/a08a34a8-6482-40c5-b458-d65a0a49b6bc',
        '/dashboard/representatives/store',
        '/dashboard/representatives/update/52d258db-1b69-44f5-aa52-bf1727a792e2',
        '/dashboard/finances'
    ];
}
