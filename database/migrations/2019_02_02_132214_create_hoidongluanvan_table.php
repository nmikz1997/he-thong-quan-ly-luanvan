<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoidongluanvanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoidongluanvan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //$table->increments('id');
            $table->char('canbo_id',10);
            $table->char('luanvan_id',8);
            $table->unsignedTinyInteger('vaitro');
            $table->float('diem')->nullable();
            
            $table->unsignedTinyInteger('gio_id')->nullable();
            $table->date('ngay_id')->nullable();
            $table->char('diadiem_id',10)->nullable();

            $table->primary(['canbo_id', 'luanvan_id']);
            $table->unique(['canbo_id','ngay_id','gio_id']);
            $table->unique(['luanvan_id','vaitro']);
            
            $table->foreign('canbo_id')->references('id')->on('canbo')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('luanvan_id')->references('id')->on('luanvan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign(['gio_id','ngay_id','diadiem_id'])->references(['gio_id','ngay_id','diadiem_id'])->on('lichbaove')->onDelete('cascade')->onUpdate('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoidongluanvan');
    }
}
