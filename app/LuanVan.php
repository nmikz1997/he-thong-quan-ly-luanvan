<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\nienkhoa;

class LuanVan extends Model
{
    protected $table = 'luanvan';
    //protected $fillable = ['diemlvtn','detai_id','tinhtrang'];
    protected $guarded = ['id','detai_id'];
    protected $primaryKey = 'id';
    
    public $incrementing    = false;
    public $timestamps      = false;

    public function sinhvien()
    {
    	return $this->belongsTo('App\SinhVien', 'id', 'id');
    }

    public function detai()
    {   
        return $this->belongsTo('App\DeTai','detai_id','id');
    }

    public function lichbaove()
    {
        return $this->hasOne('App\LichBaoVe','luanvan_id','id');
    }

    public function hoidong()
    {
        return $this->belongsToMany('App\CanBo','hoidongluanvan','luanvan_id','canbo_id')
                    ->withPivot('vaitro','diem','ngay_id','gio_id','diadiem_id')
                    ->orderBy('vaitro','desc');
        //1 luận văn tìm đc 3 cán bộ thuộc hội đồng
    }

}
