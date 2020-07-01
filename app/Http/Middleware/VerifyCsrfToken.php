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
        'http://192.168.3.74:8080/AntiCovid19/public/khaibaoytetunguyendangky',
        'http://192.168.3.74:8080/AntiCovid19/public/getThongtinnguoidung',
        'http://192.168.3.74:8080/AntiCovid19/public/api/login',
        'http://192.168.3.74:8080/AntiCovid19/public/api/checksodienthoai',
        'http://192.168.3.74:8080/AntiCovid19/public/api/logout',
        'http://192.168.3.74:8080/AntiCovid19/public/api/getTheodoisuckhoe',
        'http://192.168.3.74:8080/AntiCovid19/public/api/getThongtintheodoisuckhoe',
        'http://192.168.3.74:8080/AntiCovid19/public/api/getGuithongtinRequest',
        'http://192.168.3.74:8080/AntiCovid19/public/api/getKhaibaotiepxuc',
        'http://192.168.3.74:8080/AntiCovid19/public/api/getNguoithan',
        'http://192.168.3.74:8080/AntiCovid19/public/api/getGuithongtinNguoithan',
        'http://192.168.3.74:8080/AntiCovid19/public/api/GetXoanguoithan',
        'http://192.168.3.74:8080/AntiCovid19/public/api/getThongtinNguoithan',
        'http://192.168.3.74:8080/AntiCovid19/public/api/getCapnhatsuckhoeNguoithan'

        
        //
    ];
}
