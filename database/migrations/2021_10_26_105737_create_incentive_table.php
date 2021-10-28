<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncentiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incentive', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->date('date');
            $table->integer('ema_1')->nullable();
            $table->integer('ema_2')->nullable();
            $table->integer('ema_3')->nullable();
            $table->integer('ema_4')->nullable();
            $table->integer('ema_5')->nullable();
            $table->integer('valid_ema')->nullable();
            $table->integer('incentive')->nullable();
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
        Schema::dropIfExists('incentive');
    }
}
