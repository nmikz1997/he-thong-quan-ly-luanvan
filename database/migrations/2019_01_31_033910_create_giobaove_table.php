<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiobaoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gio', function (Blueprint $table) {
            //$table->engine = 'InnoDB';
            $table->unsignedTinyInteger('id')->autoIncrement();
            $table->time('giobatdau')->unique()->comment('Giờ bắt dầu báo cáo luận văn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gio');
    }
}
