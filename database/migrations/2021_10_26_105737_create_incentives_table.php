<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncentivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incentives', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->string('no_of_date')->nullable();
            $table->date('date');
            $table->integer('ema_1')->nullable();
            $table->integer('ema_2')->nullable();
            $table->integer('ema_3')->nullable();
            $table->integer('valid_ema')->nullable();
            $table->integer('incentive')->nullable();
            $table->decimal('complaince_rate', $precision = 4, $scale = 2)->nullable();
            $table->integer('additional_incentive')->nullable();
            $table->integer('total_incentive')->nullable();
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
        Schema::dropIfExists('incentives');
    }
}
