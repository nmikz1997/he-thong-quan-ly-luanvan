<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaDiem extends Model
{
    protected $table 		= 'diadiem';
    protected $guarded      = ['id'];
    protected $primaryKey	= 'id';
    //protected $hidden		= ['id'];
    public $incrementing 	= false;
    public $timestamps    	= false;

    public function lichbaove()
    {
    	return $this->hasMany('App\LichBaoVe','diadiem_id','id');
    }
}
