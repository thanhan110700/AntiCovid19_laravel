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
        'http://192.168.3.74:8080/AntiCovid19/public/khaibaoytetunguyen',
        'http://192.168.3.74:8080/AntiCovid19/public/api/login',
        'http://192.168.3.74:8080/AntiCovid19/public/api/checksodienthoai'
        //
    ];
}
