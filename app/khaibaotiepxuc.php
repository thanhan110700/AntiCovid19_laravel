<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khaibaotiepxuc extends Model
{
    protected $table = "khaibaotiepxuc";
    public $timestamps = false;
    public function thongtinnguoidung(){
        return $this->belongsTo('App\thongtinnguoidung2','CMT','CMT');
    }
}   

?>