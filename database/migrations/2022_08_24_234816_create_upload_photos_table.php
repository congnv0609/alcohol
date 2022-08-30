<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_photos', function (Blueprint $table) {
            $table->id();
            $table->string('account_id');
            $table->string('account');
            $table->string('photo_name');
            $table->date('date');
            $table->integer('survey_number')->default(00);
            $table->integer('question_number')->default(0000);
            $table->integer('photo_number')->default(01);
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
        Schema::dropIfExists('upload_photos');
    }
}
