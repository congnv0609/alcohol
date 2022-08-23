<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDelayTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ema1s', function (Blueprint $table) {
            $table->after('popup_time2', function ($table) {
                $table->timestamp('delay_time1')->nullable();
                $table->timestamp('delay_time2')->nullable();
                $table->timestamp('delay_time3')->nullable();
            });
        });
        Schema::table('ema2s', function (Blueprint $table) {
            $table->after('popup_time2', function ($table) {
                $table->timestamp('delay_time1')->nullable();
                $table->timestamp('delay_time2')->nullable();
                $table->timestamp('delay_time3')->nullable();
            });
        });
        Schema::table('ema3s', function (Blueprint $table) {
            $table->after('popup_time2', function ($table) {
                $table->timestamp('delay_time1')->nullable();
                $table->timestamp('delay_time2')->nullable();
                $table->timestamp('delay_time3')->nullable();
            });
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
