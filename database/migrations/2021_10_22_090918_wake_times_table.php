<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WakeTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('wake_times', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->timestamp('date_of_change')->nullable();
            $table->time('old_wake')->nullable();
            $table->time('new_wake')->nullable();
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
        //
        Schema::dropIfExists('wake_times');
    }
}
