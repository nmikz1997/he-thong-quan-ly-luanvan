<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLuanvanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('luanvan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //$table->increments('id');
            $table->char('id',8);
            //$table->float('diemlvtn',2,2)->nullable();
            $table->unsignedInteger('detai_id');
            //$table->unsignedTinyInteger('tinhtrang')->default('0');
            //$table->timestamp();            
            $table->primary('id');

            $table->foreign('detai_id')->references('id')->on('detai')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id')->references('id')->on('sinhvien')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('luanvan');
    }
}
