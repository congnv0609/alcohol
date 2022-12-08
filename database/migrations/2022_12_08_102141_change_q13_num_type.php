<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeQ13NumType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ema1s', function (Blueprint $table) {
            $table->decimal('Q13_a_num')->change();
            $table->decimal('Q13_b_num')->change();
            $table->decimal('Q13_c_num')->change();
            $table->decimal('Q13_d_num')->change();
            $table->decimal('Q13_e_num')->change();
            $table->decimal('Q13_f_num')->change();
            $table->decimal('Q13_g_num')->change();
            $table->decimal('Q13_h_num')->change();
        });
        Schema::table('ema2s', function (Blueprint $table) {
            $table->decimal('Q13_a_num')->change();
            $table->decimal('Q13_b_num')->change();
            $table->decimal('Q13_c_num')->change();
            $table->decimal('Q13_d_num')->change();
            $table->decimal('Q13_e_num')->change();
            $table->decimal('Q13_f_num')->change();
            $table->decimal('Q13_g_num')->change();
            $table->decimal('Q13_h_num')->change();
        });
        Schema::table('ema3s', function (Blueprint $table) {
            $table->decimal('Q13_a_num')->change();
            $table->decimal('Q13_b_num')->change();
            $table->decimal('Q13_c_num')->change();
            $table->decimal('Q13_d_num')->change();
            $table->decimal('Q13_e_num')->change();
            $table->decimal('Q13_f_num')->change();
            $table->decimal('Q13_g_num')->change();
            $table->decimal('Q13_h_num')->change();
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
