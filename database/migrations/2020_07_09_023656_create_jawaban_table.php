<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('jawaban');
            $table->boolean('jawaban_tepat');
            $table->unsignedBigInteger('pertanyaan_id');
            $table->foreign('pertanyaan_id')
                  ->references('id')
                  ->on('pertanyaan')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('jawaban_id');
            $table->foreign('jawaban_id')
                ->references('id')
                ->on('jawaban')
                ->onDelete('cascade');
            
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
        Schema::dropIfExists('jawaban');
    }
}
