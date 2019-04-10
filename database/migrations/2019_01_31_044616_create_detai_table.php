<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detai', function (Blueprint $table) {
            //$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('ten',100);
            $table->char('canbo_id',10)->index();
            $table->text('mota')->nullable();
            $table->unsignedTinyInteger('soluongsv');
            $table->unsignedInteger('nienkhoa_id')->index();
            
            $table->foreign('nienkhoa_id')->references('id')->on('nienkhoa')->onUpdate('cascade');
            $table->foreign('canbo_id')->references('id')->on('canbo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detai');
    }
}
