<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendDemandBids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demand_bids', function (Blueprint $table) {
          $table->integer('demand_id');
          $table->integer('price');
          $table->integer('user_id');
          $table->string('description');
          $table->decimal('order_id');
          $table->decimal('price_fee');
          $table->decimal('price_box');
          $table->decimal('price_total');
          $table->decimal('price_bid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demand_bids', function (Blueprint $table) {
            //
        });
    }
}
