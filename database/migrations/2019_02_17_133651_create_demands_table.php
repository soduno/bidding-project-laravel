<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_user');
            $table->string('product');
            $table->string('packaging');
            $table->string('country');
            $table->string('pallet');
            $table->string('boxes');
            $table->string('label');
            $table->string('lot');
            $table->string('ending_day');
            $table->string('ending_time');
            $table->string('certificates');
            $table->string('delivery');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demands');
    }
}
