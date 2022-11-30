<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQ15JText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ema3s', function (Blueprint $table) {
            $table->after('Q15_j', function ($table) {
                $table->string('Q15_j_text')->nullable()->default(8888);
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
        Schema::table('ema3s', function (Blueprint $table) {
            $table->dropColumn('Q15_j_text');
        });
    }
}
