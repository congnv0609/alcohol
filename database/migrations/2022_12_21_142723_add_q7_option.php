<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQ7Option extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ema1s', function (Blueprint $table) {
            $table->after('Q7_c', function ($table) {
                $table->string('Q7_d')->nullable()->default(8886);
            });
        });
        Schema::table('ema2s', function (Blueprint $table) {
            $table->after('Q7_c', function ($table) {
                $table->string('Q7_d')->nullable()->default(8886);
            });
        });
        Schema::table('ema3s', function (Blueprint $table) {
            $table->after('Q7_c', function ($table) {
                $table->string('Q7_d')->nullable()->default(8886);
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
        Schema::table('ema1s', function (Blueprint $table) {
            $table->dropColumn('Q7_d');
        });
        Schema::table('ema2s', function (Blueprint $table) {
            $table->dropColumn('Q7_d');
        });
        Schema::table('ema3s', function (Blueprint $table) {
            $table->dropColumn('Q7_d');
        });
    }
}
