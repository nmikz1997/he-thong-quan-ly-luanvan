<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoMon extends Model
{
    protected $table        = 'bomon';
    protected $primaryKey   = 'id';
    protected $fillable     = ['id','ten'];
    public $incrementing    = false;
    public $timestamps      = false;

    //tạo liên kết
    public function canbo()
    {
    	return $this->hasMany('App\CanBo','bomon_id','id');
    }
    
    public function detai()
    {
        return $this->hasManyThrough('App\DeTai', 'App\CanBo','bomon_id','canbo_id','id');
    }

    // public function luanvan()
    // {
    //     return $this->hasManyThrough('App\luanvan','App\Canbo','bomon_id','canbo_id','id');
    // }

    public function sinhvien()
    {
    	return $this->hasMany('App\SinhVien','bomon_id','id');
    }
    //ok

}
