<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canbo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('id',10);
            $table->string('ten',100);
            $table->char('chucdanh',10);
            $table->char('chucvu',10);
            $table->string('email',200)->unique();
            $table->char('sdt',10)->unique();
            //$table->string('password',32);
            //$table->tinyInteger('quyen');
            $table->char('bomon_id',10);

            $table->primary('id');
            $table->foreign('bomon_id')->references('id')->on('bomon')->onUpdate('cascade');
            //$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canbo');
    }
}
