<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLichbaoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichbaove', function (Blueprint $table) {
            //$table->engine = 'InnoDB';
            //$table->increments('id');
            $table->unsignedTinyInteger('gio_id');
            $table->date('ngay_id');
            $table->char('diadiem_id',10);
            //$table->char('luanvan_id',8)->nullable();
            
            $table->primary(['gio_id','ngay_id','diadiem_id']);

            $table->foreign('gio_id')->references('id')->on('gio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ngay_id')->references('ngay')->on('ngay')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('diadiem_id')->references('id')->on('diadiem')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('luanvan_id')->references('id')->on('luanvan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lichbaove');
    }
}
