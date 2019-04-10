<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CanBo extends Model
{
    protected $table        = 'canbo';
    protected $fillable     = ['id','ten','chucdanh','chucvu','email','sdt','password','quyen','bomon_id','password'];
    
    protected $hidden       = ['password'];
    protected $primaryKey   = 'id';
    public $incrementing    = false;
    public $timestamps      = false;

    public function bomon()
    {
    	return $this->belongsTo('App\BoMon','bomon_id', 'id');
    }

    public function detai()
    {
        return $this->hasMany('App\DeTai','canbo_id','id');
    }

    // public function hoidong()
    // {
    //     $this->hasManyThrough('App\Luanvan','App\DeTai','canbo_id','detai_id','id','id');
    // }
    
}
