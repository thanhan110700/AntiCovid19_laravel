<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phananh extends Model
{
    protected $table = "phananh";
    public $timestamps = false;
    public function thongtinnguoidung(){
        return $this->belongsTo('App\thongtinnguoidung2','CMT','CMT');
    }
}   

?>