<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetaidangkyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detaidangky', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('sinhvien_id',8);
            $table->unsignedInteger('detai_id');
            $table->boolean('xacnhan')->default('0');
            $table->timestamps();
            $table->unique(['sinhvien_id','detai_id']);
            $table->foreign('sinhvien_id')->references('id')->on('sinhvien')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('detai_id')->references('id')->on('detai')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detaidangky');
    }
}
