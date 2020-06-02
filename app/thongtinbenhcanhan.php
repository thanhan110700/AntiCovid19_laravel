<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thongtinnguoidung extends Model
{
    protected $table = "thongtinbenhcanhan";

    public function thongtinnguoidung(){
        return $this->belongsTo('App\thongtinnguoidung','CMT','CMT');
    }
}   

?>