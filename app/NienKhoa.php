<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NienKhoa extends Model
{
    protected $table 		= 'nienkhoa';
    //protected $fillable     = ['nambatdau','hocki'];
    protected $guarded      = ['id'];
    protected $primaryKey   = 'id';
    public $timestamps    = false;

    public function detai()
    {
    	return $this->hasMany('App\DeTai', 'nienkhoa_id', 'id');
    }
    public function luanvan()
    {
        return $this->hasManyThrough('App\LuanVan', 'App\DeTai', 'nienkhoa_id', 'detai_id', 'id');
    }

    public function ngay()
    {
    	return $this->hasMany('App\Ngay', 'nienkhoa_id', 'id');
    }

    public function sinhvien()
    {
        return $this->hasMany('App\SinhVien', 'nienkhoa_id', 'id');
    }

    public function lichbaove()
    {
        return $this->hasManyThrough('App\LichBaoVe', 'App\Ngay','nienkhoa_id','ngay_id','id');
    }

}
