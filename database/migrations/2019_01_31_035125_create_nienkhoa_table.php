<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNienkhoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nienkhoa', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedSmallInteger('nambatdau');
            $table->enum('hocki',['1','2']);
            $table->unique(['nambatdau','hocki']);
        });

        Schema::table('ngay', function (Blueprint $table) {
            $table->foreign('nienkhoa_id')->references('id')->on('nienkhoa')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ngay');
    }
}
