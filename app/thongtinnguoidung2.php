<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thongtinnguoidung2 extends Model
{
    protected $table = "thongtinnguoidung";

    public $timestamps = false;

    public function thongtinbenhcanhan()
    {
        return $this->hasMany('App\thongtinbenhcanhan', 'CMT', 'CMT');
    }
    public function theodoisuckhoe()
    {
        return $this->hasMany('App\theodoisuckhoe', 'CMT', 'CMT');
    }
    public function phananh()
    {
        return $this->hasMany('App\theodoisuckhoe', 'CMT', 'CMT');
    }
}

?>