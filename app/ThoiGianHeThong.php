<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThoiGianHeThong extends Model
{
	//const UPDATED_AT 		= 'TGHT_capNhat';

    protected $table 		= 'thoigianhethong';
    //protected $fillable 	= ['thoigianmo','thoigiandong'];
    protected $guarded 		= ['id','ten'];
    protected $dates 		= ['thoigianmo', 'thoigiandong'];
    protected $dateFormat 	= 'Y-m-d';
    protected $primaryKey 	= 'id';
    public $incrementing 	= false;
    public $timestamps    	= false;

}
