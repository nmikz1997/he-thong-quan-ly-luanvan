<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ngay extends Model
{
    protected $table 		= 'ngay';
    protected $primaryKey 	= 'ngay';
    protected $fillable 	= ['ngay'];
    protected $dates 		= ['ngay'];
    protected $dateFormat	= 'Y-m-d';
    public $incrementing    = false;
    public $timestamps      = false;

    public function lichbaove()
    {
    	return $this->hasMany('App\LichBaoVe','ngay_id','ngay');
    }
    public function nienkhoa()
    {
        return $this->belongsTo('App\NienKhoa','nienkhoa_id','id');
    }
}
