<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissiongColumnsToEma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ema1s', function (Blueprint $table) {
            $table->after('Q13_f', function ($table) {
                $table->decimal('Q13_f_num')->nullable()->default(8886);
            });
        });

        Schema::table('ema2s', function (Blueprint $table) {
            $table->after('Q13_f', function ($table) {
                $table->decimal('Q13_f_num')->nullable()->default(8886);
            });
        });

        Schema::table('ema3s', function (Blueprint $table) {
            $table->after('Q13_f', function ($table) {
                $table->decimal('Q13_f_num')->nullable()->default(8886);
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
            $table->dropColumn('Q13_f_num');
        });
        Schema::table('ema2s', function (Blueprint $table) {
            $table->dropColumn('Q13_f_num');
        });
        Schema::table('ema3s', function (Blueprint $table) {
            $table->dropColumn('Q13_f_num');
        });
    }
}
