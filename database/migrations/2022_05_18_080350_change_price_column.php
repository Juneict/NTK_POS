<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePriceColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->integer('price')->change();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->integer('amount')->change();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->integer('price')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
        Schema::table('payments', function (Blueprint $table) {
            //
        });
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
