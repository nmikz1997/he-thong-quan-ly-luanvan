<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    protected $table = 'sinhvien';
    protected $fillable = ['id','ten','gioitinh','khoa','email','SDT','password','bangdiem','nienkhoa_id','bomon_id'];
    protected $primaryKey = 'id';
    protected $hidden = ['password'];

    public $incrementing    = false;
    public $timestamps      = false;

    public function bomon()
    {
    	return $this->belongsTo('App\BoMon', 'bomon_id', 'id');
    }

    public function luanvan()
    {
    	return $this->hasOne('App\LuanVan', 'luanvan_id', 'id');
    }

    public function detai()
    {
        return $this->belongsToMany('App\Detai','detaidangky','sinhvien_id','detai_id')->withPivot('xacnhan')->withTimestamps();
    }

}
