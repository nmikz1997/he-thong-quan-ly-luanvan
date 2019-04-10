<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LichBaoVe extends Model
{
    protected $table        = 'lichbaove';
    //protected $fillable     = ['luanvan_id'];
    protected $primaryKey   = ['gio_id','ngay_id','diadiem_id'];
    protected $dates        = ['ngay_id'];
    protected $dateFormat	= 'Y-m-d';
    public $incrementing    = false;
    public $timestamps      = false;


    public function diadiem()
    {
    	return $this->belongsTo('App\DiaDiem','diadiem_id','id');
    }

    public function gio()
    {
    	return $this->belongsTo('App\Gio','gio_id','id');
    }

    public function ngay()
    {
    	return $this->belongsTo('App\Ngay','ngay_id','ngay');
    }

    // public function luanvan()
    // {
    //     return $this->belongsTo('App\LuanVan','luanvan_id','id');
    // }
}
