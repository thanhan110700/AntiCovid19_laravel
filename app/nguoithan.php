<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nguoithan extends Model
{
    protected $table = "nguoithan";
    public $timestamps = false;
    public function thongtinnguoidung(){
        return $this->belongsTo('App\thongtinnguoidung2','CMT','CMT');
    }
}   

?>