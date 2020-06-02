<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thongtinnguoidung extends Model
{
    protected $table = "thongtinnguoidung";
    protected $fillable = [
        'hovaten',
        'CMT',
        'BHXH',
        'ngaysinh',
        'gioitinh',
        'quoctich',
        'diachi',
        'sodienthoai',
        'email'
    ];

    public function comments()
    {
        return $this->hasMany('App\thongtinbenhcanhan', 'CMT', 'CMT');
    }
}

?>