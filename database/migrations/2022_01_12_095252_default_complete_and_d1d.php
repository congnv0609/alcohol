<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DefaultCompleteAndD1d extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ema1s', function (Blueprint $table) {
            $table->integer('completed')->nullable()->default(NULL)->change();
        });
        Schema::table('ema2s', function (Blueprint $table) {
            $table->integer('completed')->nullable()->default(NULL)->change();
        });
        Schema::table('ema3s', function (Blueprint $table) {
            $table->integer('completed')->nullable()->default(NULL)->change();
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
