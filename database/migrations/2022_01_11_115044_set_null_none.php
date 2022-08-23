<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetNullNone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ema1s', function (Blueprint $table) {
            $table->integer('b2_none')->nullable()->default(NULL)->change();
            $table->integer('b3_none')->nullable()->default(NULL)->change();
            $table->integer('b4_none')->nullable()->default(NULL)->change();
            $table->integer('b7_none')->nullable()->default(NULL)->change();
            $table->integer('b10_none')->nullable()->default(NULL)->change();
            $table->integer('b13_none')->nullable()->default(NULL)->change();
            $table->integer('b14_none')->nullable()->default(NULL)->change();
            $table->integer('b15_none')->nullable()->default(NULL)->change();
            $table->integer('b16_none')->nullable()->default(NULL)->change();
        });

        Schema::table('ema2s', function (Blueprint $table) {
            $table->integer('b2_none')->nullable()->default(NULL)->change();
            $table->integer('b3_none')->nullable()->default(NULL)->change();
            $table->integer('b4_none')->nullable()->default(NULL)->change();
            $table->integer('b7_none')->nullable()->default(NULL)->change();
            $table->integer('b10_none')->nullable()->default(NULL)->change();
            $table->integer('b13_none')->nullable()->default(NULL)->change();
            $table->integer('b14_none')->nullable()->default(NULL)->change();
            $table->integer('b15_none')->nullable()->default(NULL)->change();
            $table->integer('b16_none')->nullable()->default(NULL)->change();
        });

        Schema::table('ema3s', function (Blueprint $table) {
            $table->integer('b2_none')->nullable()->default(NULL)->change();
            $table->integer('b3_none')->nullable()->default(NULL)->change();
            $table->integer('b4_none')->nullable()->default(NULL)->change();
            $table->integer('b7_none')->nullable()->default(NULL)->change();
            $table->integer('b10_none')->nullable()->default(NULL)->change();
            $table->integer('b13_none')->nullable()->default(NULL)->change();
            $table->integer('b14_none')->nullable()->default(NULL)->change();
            $table->integer('b15_none')->nullable()->default(NULL)->change();
            $table->integer('b16_none')->nullable()->default(NULL)->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
