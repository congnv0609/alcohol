<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smokers', function (Blueprint $table) {
            $table->id();
            $table->string('account');
            $table->integer('term');
            $table->timestamp('startDate')->nullable();
            $table->timestamp('endDate')->nullable();
            $table->integer('prompt_ema')->default(0);
            $table->integer('response_ema')->default(0);
            $table->integer('non_response_ema')->default(0);
            $table->integer('future_ema')->default(0);
            $table->decimal('response_rate', $precision = 10, $scale = 8)->nullable();
            $table->integer('status')->default(0);
            $table->integer('notification')->default(1);
            $table->string('device_token')->nullable();
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
        Schema::dropIfExists('smokers');
    }
}
