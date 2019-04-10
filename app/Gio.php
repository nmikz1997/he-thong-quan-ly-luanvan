<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gio extends Model
{
    protected $table = 'gio';
    protected $fillable = ['giobatdau'];
    //protected $guarded = ['id'];
    protected $primaryKey = 'id';
    public $incrementing    = false;
    public $timestamps      = false;

    public function lichbaove()
    {
    	return $this->hasMany('App\LichBaoVe','gio_id','id');
    }
}
