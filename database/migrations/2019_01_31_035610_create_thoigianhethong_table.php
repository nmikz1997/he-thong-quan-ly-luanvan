<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThoigianhethongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thoigianhethong', function (Blueprint $table) {
            //$table->char('id',10);
            $table->string('ten');
            $table->date('thoigianmo');
            $table->date('thoigiandong');
            $table->primary('id');
            //$table->timestamp('TGHT_capNhat')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thoigianhethong');
    }
}
