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
            $table->boolean('completed')->default(false);

            $table->integer('t1')->nullable();

            $table->boolean('c1_a')->default(false);
            $table->boolean('c1_b')->default(false);
            $table->boolean('c1_c')->default(false);
            $table->boolean('c1_d')->default(false);
            $table->boolean('c1_e')->default(false);
            $table->boolean('c1_f')->default(false);
            $table->boolean('c1_g')->default(false);
            $table->boolean('c1_h')->default(false);
            $table->boolean('c1_i')->default(false);

            $table->boolean('c2_a')->default(false);
            $table->boolean('c2_b')->default(false);
            $table->boolean('c2_c')->default(false);
            $table->boolean('c2_d')->default(false);
            $table->boolean('c2_e')->default(false);
            $table->boolean('c2_f')->default(false);
            $table->boolean('c2_g')->default(false);
            $table->boolean('c2_h')->default(false);
            $table->boolean('c2_i')->default(false);
            $table->boolean('c2_j')->default(false);
            $table->boolean('c2_k')->default(false);
            $table->boolean('c2_l')->default(false);
            $table->boolean('c2_m')->default(false);
            $table->boolean('c2_n')->default(false);
            $table->boolean('c2_o')->default(false);
            $table->boolean('c2_p')->default(false);
            $table->boolean('c2_q')->default(false);

            $table->boolean('c3_a')->default(false);
            $table->boolean('c3_b')->default(false);
            $table->boolean('c3_c')->default(false);
            $table->boolean('c3_d')->default(false);
            $table->boolean('c3_e')->default(false);
            $table->boolean('c3_f')->default(false);

            $table->boolean('b1_a')->default(false);
            $table->unsignedFloat('b1_a_num')->nullable();
            $table->boolean('b1_b')->default(false);
            $table->unsignedFloat('b1_b_num')->nullable();
            $table->boolean('b1_c')->default(false);
            $table->unsignedFloat('b1_c_num')->nullable();
            $table->boolean('b1_d')->default(false);
            $table->boolean('b1_e')->default(false);
            $table->boolean('b1_f')->default(false);
            $table->boolean('b1_g')->default(false);
            $table->boolean('b1_h')->default(false);
            $table->boolean('b1_i')->default(false);
            $table->boolean('b1_j')->default(false);

            $table->integer('b2_c1a')->nullable();
            $table->integer('b2_c1b')->nullable();
            $table->integer('b2_c1c')->nullable();
            $table->integer('b2_c1d')->nullable();
            $table->integer('b2_c1e')->nullable();
            $table->integer('b2_c1f')->nullable();
            $table->integer('b2_c1g')->nullable();
            $table->integer('b2_c1h')->nullable();

            $table->integer('b2_c2a')->nullable();
            $table->integer('b2_c2b')->nullable();
            $table->integer('b2_c2c')->nullable();
            $table->integer('b2_c2d')->nullable();
            $table->integer('b2_c2e')->nullable();
            $table->integer('b2_c2f')->nullable();
            $table->integer('b2_c2g')->nullable();
            $table->integer('b2_c2h')->nullable();
            $table->integer('b2_c2i')->nullable();
            $table->integer('b2_c2j')->nullable();
            $table->integer('b2_c2k')->nullable();
            $table->integer('b2_c2l')->nullable();
            $table->integer('b2_c2m')->nullable();
            $table->integer('b2_c2n')->nullable();
            $table->integer('b2_c2o')->nullable();
            $table->integer('b2_c2p')->nullable();

            $table->integer('b2_c3a')->nullable();
            $table->integer('b2_c3b')->nullable();
            $table->integer('b2_c3c')->nullable();
            $table->integer('b2_c3d')->nullable();
            $table->integer('b2_c3e')->nullable();
            $table->integer('b2_none')->default(0);

            $table->integer('b3_c1a')->nullable();
            $table->integer('b3_c1b')->nullable();
            $table->integer('b3_c1c')->nullable();
            $table->integer('b3_c1d')->nullable();
            $table->integer('b3_c1e')->nullable();
            $table->integer('b3_c1f')->nullable();
            $table->integer('b3_c1g')->nullable();
            $table->integer('b3_c1h')->nullable();

            $table->integer('b3_c2a')->nullable();
            $table->integer('b3_c2b')->nullable();
            $table->integer('b3_c2c')->nullable();
            $table->integer('b3_c2d')->nullable();
            $table->integer('b3_c2e')->nullable();
            $table->integer('b3_c2f')->nullable();
            $table->integer('b3_c2g')->nullable();
            $table->integer('b3_c2h')->nullable();
            $table->integer('b3_c2i')->nullable();
            $table->integer('b3_c2j')->nullable();
            $table->integer('b3_c2k')->nullable();
            $table->integer('b3_c2l')->nullable();
            $table->integer('b3_c2m')->nullable();
            $table->integer('b3_c2n')->nullable();
            $table->integer('b3_c2o')->nullable();
            $table->integer('b3_c2p')->nullable();

            $table->integer('b3_c3a')->nullable();
            $table->integer('b3_c3b')->nullable();
            $table->integer('b3_c3c')->nullable();
            $table->integer('b3_c3d')->nullable();
            $table->integer('b3_c3e')->nullable();
            $table->integer('b3_none')->default(0);

            $table->integer('b4_c1a')->nullable();
            $table->integer('b4_c1b')->nullable();
            $table->integer('b4_c1c')->nullable();
            $table->integer('b4_c1d')->nullable();
            $table->integer('b4_c1e')->nullable();
            $table->integer('b4_c1f')->nullable();
            $table->integer('b4_c1g')->nullable();
            $table->integer('b4_c1h')->nullable();

            $table->integer('b4_c2a')->nullable();
            $table->integer('b4_c2b')->nullable();
            $table->integer('b4_c2c')->nullable();
            $table->integer('b4_c2d')->nullable();
            $table->integer('b4_c2e')->nullable();
            $table->integer('b4_c2f')->nullable();
            $table->integer('b4_c2g')->nullable();
            $table->integer('b4_c2h')->nullable();
            $table->integer('b4_c2i')->nullable();
            $table->integer('b4_c2j')->nullable();
            $table->integer('b4_c2k')->nullable();
            $table->integer('b4_c2l')->nullable();
            $table->integer('b4_c2m')->nullable();
            $table->integer('b4_c2n')->nullable();
            $table->integer('b4_c2o')->nullable();
            $table->integer('b4_c2p')->nullable();

            $table->integer('b4_c3a')->nullable();
            $table->integer('b4_c3b')->nullable();
            $table->integer('b4_c3c')->nullable();
            $table->integer('b4_c3d')->nullable();
            $table->integer('b4_c3e')->nullable();
            $table->integer('b4_none')->default(0);

            $table->integer('b5')->nullable();

            $table->boolean('b6_a')->default(false);
            $table->boolean('b6_b')->default(false);
            $table->boolean('b6_c')->default(false);

            $table->integer('b7_c1a')->nullable();
            $table->integer('b7_c1b')->nullable();
            $table->integer('b7_c1c')->nullable();
            $table->integer('b7_c1d')->nullable();
            $table->integer('b7_c1e')->nullable();
            $table->integer('b7_c1f')->nullable();
            $table->integer('b7_c1g')->nullable();
            $table->integer('b7_c1h')->nullable();

            $table->integer('b7_c2a')->nullable();
            $table->integer('b7_c2b')->nullable();
            $table->integer('b7_c2c')->nullable();
            $table->integer('b7_c2d')->nullable();
            $table->integer('b7_c2e')->nullable();
            $table->integer('b7_c2f')->nullable();
            $table->integer('b7_c2g')->nullable();
            $table->integer('b7_c2h')->nullable();
            $table->integer('b7_c2i')->nullable();
            $table->integer('b7_c2j')->nullable();
            $table->integer('b7_c2k')->nullable();
            $table->integer('b7_c2l')->nullable();
            $table->integer('b7_c2m')->nullable();
            $table->integer('b7_c2n')->nullable();
            $table->integer('b7_c2o')->nullable();
            $table->integer('b7_c2p')->nullable();

            $table->integer('b7_c3a')->nullable();
            $table->integer('b7_c3b')->nullable();
            $table->integer('b7_c3c')->nullable();
            $table->integer('b7_c3d')->nullable();
            $table->integer('b7_c3e')->nullable();
            $table->integer('b7_none')->default(0);

            $table->integer('b8')->nullable();

            $table->boolean('b9_a')->default(false);
            $table->boolean('b9_b')->default(false);
            $table->boolean('b9_c')->default(false);

            $table->integer('b10_c1a')->nullable();
            $table->integer('b10_c1b')->nullable();
            $table->integer('b10_c1c')->nullable();
            $table->integer('b10_c1d')->nullable();
            $table->integer('b10_c1e')->nullable();
            $table->integer('b10_c1f')->nullable();
            $table->integer('b10_c1g')->nullable();
            $table->integer('b10_c1h')->nullable();

            $table->integer('b10_c2a')->nullable();
            $table->integer('b10_c2b')->nullable();
            $table->integer('b10_c2c')->nullable();
            $table->integer('b10_c2d')->nullable();
            $table->integer('b10_c2e')->nullable();
            $table->integer('b10_c2f')->nullable();
            $table->integer('b10_c2g')->nullable();
            $table->integer('b10_c2h')->nullable();
            $table->integer('b10_c2i')->nullable();
            $table->integer('b10_c2j')->nullable();
            $table->integer('b10_c2k')->nullable();
            $table->integer('b10_c2l')->nullable();
            $table->integer('b10_c2m')->nullable();
            $table->integer('b10_c2n')->nullable();
            $table->integer('b10_c2o')->nullable();
            $table->integer('b10_c2p')->nullable();

            $table->integer('b10_c3a')->nullable();
            $table->integer('b10_c3b')->nullable();
            $table->integer('b10_c3c')->nullable();
            $table->integer('b10_c3d')->nullable();
            $table->integer('b10_c3e')->nullable();
            $table->integer('b10_none')->default(0);

            $table->integer('b11')->nullable();

            $table->boolean('b12_a')->default(false);
            $table->boolean('b12_b')->default(false);
            $table->boolean('b12_c')->default(false);

            $table->integer('b13_c1a')->nullable();
            $table->integer('b13_c1b')->nullable();
            $table->integer('b13_c1c')->nullable();
            $table->integer('b13_c1d')->nullable();
            $table->integer('b13_c1e')->nullable();
            $table->integer('b13_c1f')->nullable();
            $table->integer('b13_c1g')->nullable();
            $table->integer('b13_c1h')->nullable();

            $table->integer('b13_c2a')->nullable();
            $table->integer('b13_c2b')->nullable();
            $table->integer('b13_c2c')->nullable();
            $table->integer('b13_c2d')->nullable();
            $table->integer('b13_c2e')->nullable();
            $table->integer('b13_c2f')->nullable();
            $table->integer('b13_c2g')->nullable();
            $table->integer('b13_c2h')->nullable();
            $table->integer('b13_c2i')->nullable();
            $table->integer('b13_c2j')->nullable();
            $table->integer('b13_c2k')->nullable();
            $table->integer('b13_c2l')->nullable();
            $table->integer('b13_c2m')->nullable();
            $table->integer('b13_c2n')->nullable();
            $table->integer('b13_c2o')->nullable();
            $table->integer('b13_c2p')->nullable();

            $table->integer('b13_c3a')->nullable();
            $table->integer('b13_c3b')->nullable();
            $table->integer('b13_c3c')->nullable();
            $table->integer('b13_c3d')->nullable();
            $table->integer('b13_c3e')->nullable();
            $table->integer('b13_none')->default(0);

            $table->integer('b14_c1a')->nullable();
            $table->integer('b14_c1b')->nullable();
            $table->integer('b14_c1c')->nullable();
            $table->integer('b14_c1d')->nullable();
            $table->integer('b14_c1e')->nullable();
            $table->integer('b14_c1f')->nullable();
            $table->integer('b14_c1g')->nullable();
            $table->integer('b14_c1h')->nullable();

            $table->integer('b14_c2a')->nullable();
            $table->integer('b14_c2b')->nullable();
            $table->integer('b14_c2c')->nullable();
            $table->integer('b14_c2d')->nullable();
            $table->integer('b14_c2e')->nullable();
            $table->integer('b14_c2f')->nullable();
            $table->integer('b14_c2g')->nullable();
            $table->integer('b14_c2h')->nullable();
            $table->integer('b14_c2i')->nullable();
            $table->integer('b14_c2j')->nullable();
            $table->integer('b14_c2k')->nullable();
            $table->integer('b14_c2l')->nullable();
            $table->integer('b14_c2m')->nullable();
            $table->integer('b14_c2n')->nullable();
            $table->integer('b14_c2o')->nullable();
            $table->integer('b14_c2p')->nullable();

            $table->integer('b14_c3a')->nullable();
            $table->integer('b14_c3b')->nullable();
            $table->integer('b14_c3c')->nullable();
            $table->integer('b14_c3d')->nullable();
            $table->integer('b14_c3e')->nullable();
            $table->integer('b14_none')->default(0);

            $table->integer('b15_c1a')->nullable();
            $table->integer('b15_c1b')->nullable();
            $table->integer('b15_c1c')->nullable();
            $table->integer('b15_c1d')->nullable();
            $table->integer('b15_c1e')->nullable();
            $table->integer('b15_c1f')->nullable();
            $table->integer('b15_c1g')->nullable();
            $table->integer('b15_c1h')->nullable();

            $table->integer('b15_c2a')->nullable();
            $table->integer('b15_c2b')->nullable();
            $table->integer('b15_c2c')->nullable();
            $table->integer('b15_c2d')->nullable();
            $table->integer('b15_c2e')->nullable();
            $table->integer('b15_c2f')->nullable();
            $table->integer('b15_c2g')->nullable();
            $table->integer('b15_c2h')->nullable();
            $table->integer('b15_c2i')->nullable();
            $table->integer('b15_c2j')->nullable();
            $table->integer('b15_c2k')->nullable();
            $table->integer('b15_c2l')->nullable();
            $table->integer('b15_c2m')->nullable();
            $table->integer('b15_c2n')->nullable();
            $table->integer('b15_c2o')->nullable();
            $table->integer('b15_c2p')->nullable();

            $table->integer('b15_c3a')->nullable();
            $table->integer('b15_c3b')->nullable();
            $table->integer('b15_c3c')->nullable();
            $table->integer('b15_c3d')->nullable();
            $table->integer('b15_c3e')->nullable();
            $table->integer('b15_none')->default(0);

            $table->integer('b16_c1a')->nullable();
            $table->integer('b16_c1b')->nullable();
            $table->integer('b16_c1c')->nullable();
            $table->integer('b16_c1d')->nullable();
            $table->integer('b16_c1e')->nullable();
            $table->integer('b16_c1f')->nullable();
            $table->integer('b16_c1g')->nullable();
            $table->integer('b16_c1h')->nullable();

            $table->integer('b16_c2a')->nullable();
            $table->integer('b16_c2b')->nullable();
            $table->integer('b16_c2c')->nullable();
            $table->integer('b16_c2d')->nullable();
            $table->integer('b16_c2e')->nullable();
            $table->integer('b16_c2f')->nullable();
            $table->integer('b16_c2g')->nullable();
            $table->integer('b16_c2h')->nullable();
            $table->integer('b16_c2i')->nullable();
            $table->integer('b16_c2j')->nullable();
            $table->integer('b16_c2k')->nullable();
            $table->integer('b16_c2l')->nullable();
            $table->integer('b16_c2m')->nullable();
            $table->integer('b16_c2n')->nullable();
            $table->integer('b16_c2o')->nullable();
            $table->integer('b16_c2p')->nullable();

            $table->integer('b16_c3a')->nullable();
            $table->integer('b16_c3b')->nullable();
            $table->integer('b16_c3c')->nullable();
            $table->integer('b16_c3d')->nullable();
            $table->integer('b16_c3e')->nullable();
            $table->integer('b16_none')->default(0);

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
