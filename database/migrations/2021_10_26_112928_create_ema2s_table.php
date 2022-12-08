<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEma2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ema2s', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->date('date');
            $table->integer('nth_day');
            $table->integer('nth_ema')->default(2);
            $table->integer('nth_popup')->default(0);
            $table->timestamp('popup_time')->nullable();
            $table->timestamp('popup_time1')->nullable();
            $table->timestamp('popup_time2')->nullable();
            $table->timestamp('attempt_time')->nullable();
            $table->timestamp('submit_time')->nullable();
            $table->integer('time_taken')->nullable();
            $table->integer('completed')->nullable()->default(8886);
            $table->integer('1st_reminder')->nullable()->default(8886);
            $table->integer('2nd_reminder')->nullable()->default(8888);
            $table->integer('3rd_reminder')->nullable()->default(8888);

            $table->integer('Q1')->nullable();
            $table->integer('Q1_1')->nullable()->default(8886);
            $table->integer('Q1_a')->nullable()->default(8886);
            $table->integer('Q1_b')->nullable()->default(8886);
            $table->integer('Q1_c')->nullable()->default(8886);

            $table->integer('Q2_1a')->nullable()->default(8886);
            $table->integer('Q2_1b')->nullable()->default(8886);
            $table->integer('Q2_1c')->nullable()->default(8886);
            $table->integer('Q2_1d')->nullable()->default(8886);
            $table->integer('Q2_1e')->nullable()->default(8886);
            $table->integer('Q2_2f')->nullable()->default(8886);
            $table->integer('Q2_2g')->nullable()->default(8886);
            $table->integer('Q2_2h')->nullable()->default(8886);
            $table->integer('Q2_2i')->nullable()->default(8886);
            $table->integer('Q2_2j')->nullable()->default(8886);
            $table->integer('Q2_3k')->nullable()->default(8886);
            $table->integer('Q2_3l')->nullable()->default(8886);
            $table->integer('Q2_3m')->nullable()->default(8886);
            $table->integer('Q2_3n')->nullable()->default(8886);
            $table->integer('Q2_3o')->nullable()->default(8886);

            $table->integer('Q3')->nullable()->default(8886);
            $table->integer('Q3_a')->nullable()->default(8886);
            $table->integer('Q3_aa')->nullable()->default(8886);
            $table->integer('Q3_ab')->nullable()->default(8886);
            $table->integer('Q3_ac')->nullable()->default(8886);
            $table->integer('Q3_ad')->nullable()->default(8886);
            $table->integer('Q3_ae')->nullable()->default(8886);
            $table->integer('Q3_b')->nullable()->default(8886);
            $table->integer('Q3_ba')->nullable()->default(8886);
            $table->integer('Q3_bb')->nullable()->default(8886);
            $table->integer('Q3_bc')->nullable()->default(8886);
            $table->integer('Q3_bd')->nullable()->default(8886);
            $table->integer('Q3_be')->nullable()->default(8886);
            $table->integer('Q3_c')->nullable()->default(8886);
            $table->integer('Q3_ca')->nullable()->default(8886);
            $table->integer('Q3_cb')->nullable()->default(8886);
            $table->integer('Q3_cc')->nullable()->default(8886);
            $table->integer('Q3_cd')->nullable()->default(8886);

            $table->integer('Q3_d')->nullable()->default(8886);
            $table->integer('Q3_da')->nullable()->default(8886);
            $table->integer('Q3_db')->nullable()->default(8886);
            $table->integer('Q3_dc')->nullable()->default(8886);
            $table->string('Q3_dc_text')->nullable()->default(8886);
            $table->integer('Q3_e')->nullable()->default(8886);

            $table->integer('Q4')->nullable()->default(8886);
            $table->integer('Q4_a')->nullable()->default(8886);
            $table->integer('Q4_b')->nullable()->default(8886);
            $table->integer('Q4_c')->nullable()->default(8886);
            $table->integer('Q4_d')->nullable()->default(8886);
            $table->integer('Q4_e')->nullable()->default(8886);
            $table->integer('Q4_f')->nullable()->default(8886);
            $table->integer('Q4_g')->nullable()->default(8886);
            $table->string('Q4_g_text')->nullable()->default(8886);

            $table->integer('Q5')->nullable()->default(8886);
            $table->integer('Q5_a')->nullable()->default(8886);
            $table->integer('Q5_b')->nullable()->default(8886);
            $table->integer('Q5_c')->nullable()->default(8886);
            $table->integer('Q5_d')->nullable()->default(8886);
            $table->integer('Q5_e')->nullable()->default(8886);
            $table->integer('Q5_f')->nullable()->default(8886);
            $table->integer('Q5_g')->nullable()->default(8886);
            $table->integer('Q5_h')->nullable()->default(8886);
            $table->string('Q5_h_text')->nullable()->default(8886);
            $table->integer('Q5_i')->nullable()->default(8886);

            $table->integer('Q6')->nullable()->default(8886);
            $table->integer('Q6_1')->nullable()->default(8886);
            $table->integer('Q6_2')->nullable()->default(8886);
            $table->integer('Q6_3')->nullable()->default(8886);
            $table->integer('Q6_4')->nullable()->default(8886);

            $table->integer('Q7')->nullable()->default(8886);
            $table->integer('Q7_a')->nullable()->default(8886);
            $table->integer('Q7_b')->nullable()->default(8886);
            $table->integer('Q7_c')->nullable()->default(8886);

            $table->integer('Q8_1a')->nullable()->default(8886);
            $table->integer('Q8_1b')->nullable()->default(8886);
            $table->integer('Q8_1c')->nullable()->default(8886);
            $table->integer('Q8_1d')->nullable()->default(8886);
            $table->integer('Q8_1e')->nullable()->default(8886);
            $table->integer('Q8_2f')->nullable()->default(8886);
            $table->integer('Q8_2g')->nullable()->default(8886);
            $table->integer('Q8_2h')->nullable()->default(8886);
            $table->integer('Q8_2i')->nullable()->default(8886);
            $table->integer('Q8_2j')->nullable()->default(8886);
            $table->integer('Q8_3k')->nullable()->default(8886);
            $table->integer('Q8_3l')->nullable()->default(8886);
            $table->integer('Q8_3m')->nullable()->default(8886);
            $table->integer('Q8_3n')->nullable()->default(8886);
            $table->integer('Q8_3o')->nullable()->default(8886);

            $table->integer('Q9')->nullable()->default(8886);
            $table->integer('Q9_a')->nullable()->default(8886);
            $table->integer('Q9_aa')->nullable()->default(8886);
            $table->integer('Q9_ab')->nullable()->default(8886);
            $table->integer('Q9_ac')->nullable()->default(8886);
            $table->integer('Q9_ad')->nullable()->default(8886);
            $table->integer('Q9_ae')->nullable()->default(8886);
            $table->integer('Q9_b')->nullable()->default(8886);
            $table->integer('Q9_ba')->nullable()->default(8886);
            $table->integer('Q9_bb')->nullable()->default(8886);
            $table->integer('Q9_bc')->nullable()->default(8886);
            $table->integer('Q9_bd')->nullable()->default(8886);
            $table->integer('Q9_be')->nullable()->default(8886);
            $table->integer('Q9_c')->nullable()->default(8886);
            $table->integer('Q9_ca')->nullable()->default(8886);
            $table->integer('Q9_cb')->nullable()->default(8886);
            $table->integer('Q9_cc')->nullable()->default(8886);
            $table->integer('Q9_cd')->nullable()->default(8886);
            $table->integer('Q9_d')->nullable()->default(8886);
            $table->integer('Q9_da')->nullable()->default(8886);
            $table->integer('Q9_db')->nullable()->default(8886);
            $table->integer('Q9_dc')->nullable()->default(8886);
            $table->string('Q9_dc_text')->nullable()->default(8886);
            $table->integer('Q9_e')->nullable()->default(8886);

            $table->integer('Q10')->nullable()->default(8886);
            $table->integer('Q10_a')->nullable()->default(8886);
            $table->integer('Q10_b')->nullable()->default(8886);
            $table->integer('Q10_c')->nullable()->default(8886);
            $table->integer('Q10_d')->nullable()->default(8886);
            $table->integer('Q10_e')->nullable()->default(8886);
            $table->integer('Q10_f')->nullable()->default(8886);
            $table->integer('Q10_g')->nullable()->default(8886);
            $table->integer('Q10_h')->nullable()->default(8886);
            $table->string('Q10_h_text')->nullable()->default(8886);
            $table->integer('Q10_i')->nullable()->default(8886);

            $table->integer('Q11')->nullable()->default(8886);

            $table->integer('Q12')->nullable()->default(8886);
            $table->integer('Q12_a')->nullable()->default(8886);
            $table->decimal('Q12_a_num')->nullable()->default(8886);
            $table->integer('Q12_b')->nullable()->default(8886);
            $table->decimal('Q12_b_num')->nullable()->default(8886);
            $table->integer('Q12_c')->nullable()->default(8886);
            $table->decimal('Q12_c_num')->nullable()->default(8886);
            $table->integer('Q12_d')->nullable()->default(8886);
            $table->decimal('Q12_d_num')->nullable()->default(8886);
            $table->integer('Q12_e')->nullable()->default(8886);
            $table->decimal('Q12_e_num')->nullable()->default(8886);
            $table->integer('Q12_f')->nullable()->default(8886);
            $table->decimal('Q12_f_num')->nullable()->default(8886);
            $table->integer('Q12_g')->nullable()->default(8886);
            $table->decimal('Q12_g_num')->nullable()->default(8886);
            $table->integer('Q12_h')->nullable()->default(8886);
            $table->decimal('Q12_h_num')->nullable()->default(8886);
            $table->integer('Q12_i')->nullable()->default(8886);
            $table->string('Q12_i_text')->nullable()->default(8886);
            $table->decimal('Q12_i_num')->nullable()->default(8886);
            $table->integer('Q12_j')->nullable()->default(8886);

            $table->integer('Q13')->nullable()->default(8886);
            $table->integer('Q13_a')->nullable()->default(8886);
            $table->decimal('Q13_a_num')->nullable()->default(8886);
            $table->integer('Q13_b')->nullable()->default(8886);
            $table->decimal('Q13_b_num')->nullable()->default(8886);
            $table->integer('Q13_c')->nullable()->default(8886);
            $table->decimal('Q13_c_num')->nullable()->default(8886);
            $table->integer('Q13_d')->nullable()->default(8886);
            $table->decimal('Q13_d_num')->nullable()->default(8886);
            $table->integer('Q13_e')->nullable()->default(8886);
            $table->decimal('Q13_e_num')->nullable()->default(8886);
            $table->integer('Q13_f')->nullable()->default(8886);
            $table->integer('Q13_g')->nullable()->default(8886);
            $table->decimal('Q13_g_num')->nullable()->default(8886);
            $table->integer('Q13_h')->nullable()->default(8886);
            $table->string('Q13_h_text')->nullable()->default(8886);
            $table->decimal('Q13_h_num')->nullable()->default(8886);
            $table->integer('Q13_i')->nullable()->default(8886);

            $table->integer('Q14')->nullable()->default(8886);

            

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
        Schema::dropIfExists('ema2s');
    }
}
