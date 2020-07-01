<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class theodoisuckhoe extends Model
{
    protected $table = "theodoisuckhoe";
    public $timestamps = false;
    public function thongtinnguoidung(){
        return $this->belongsTo('App\thongtinnguoidung2','CMT','CMT');
    }
}   

?>