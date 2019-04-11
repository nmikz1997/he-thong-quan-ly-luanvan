<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgaybaoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngay', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->date('ngay');
            $table->unsignedInteger('nienkhoa_id');
            
            $table->primary('ngay');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nienkhoa');
    }
}
