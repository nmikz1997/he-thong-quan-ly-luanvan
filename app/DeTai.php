<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeTai extends Model
{   
    protected $table = 'detai';
    protected $fillable = ['ten','mota','soluongsv'];
    protected $primaryKey = 'id';
    //public $incrementing    = false;
    public $timestamps      = false;

    //tạo liên kết
    public function nienkhoa()
    {
    	return $this->belongsTo('App\NienKhoa','nienkhoa_id','id');
    }

    public function canbo()
    {
    	return $this->belongsTo('App\CanBo','canbo_id','id');
    }

    public function bomon()
    {
        return $this->belongsTo('App\BoMon','bomon_id','id');
    }

    public function luanvan()
    {
    	return $this->hasMany('App\LuanVan','detai_id','id');
    }

    public function sinhvien()
    {
        return $this->belongsToMany('App\SinhVien','detaidangky','detai_id','sinhvien_id')->withPivot('xacnhan')->withTimestamps();
    }

}
