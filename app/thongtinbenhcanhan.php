<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thongtinbenhcanhan extends Model
{
    protected $table = "thongtinbenhcanhan";
    public $timestamps = false;
    public function thongtinnguoidung(){
        return $this->belongsTo('App\thongtinnguoidung2','CMT','CMT');
    }
}   

?>