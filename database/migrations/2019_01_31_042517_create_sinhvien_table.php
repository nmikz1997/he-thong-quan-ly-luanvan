<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinhvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinhvien', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('id',8);
            $table->string('ten');
            $table->boolean('gioitinh');
            $table->char('khoa',3)->comment('khóa học của sinh viên: K41,K42...');
            $table->string('email',200)->unique();
            $table->char('SDT',10)->unique();
            //$table->string('password',32);
            $table->string('bangdiem')->nullable();
            
            $table->char('bomon_id',10);
            $table->unsignedInteger('nienkhoa_id');
            
            $table->primary('id');
            
            $table->foreign('bomon_id')->references('id')->on('bomon')->onUpdate('cascade');
            $table->foreign('nienkhoa_id')->references('id')->on('nienkhoa')->onUpdate('cascade');
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
        Schema::dropIfExists('sinhvien');
    }
}
