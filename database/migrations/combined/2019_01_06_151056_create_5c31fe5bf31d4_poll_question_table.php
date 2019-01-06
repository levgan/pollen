<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c31fe5bf31d4PollQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('poll_question')) {
            Schema::create('poll_question', function (Blueprint $table) {
                $table->integer('poll_id')->unsigned()->nullable();
                $table->foreign('poll_id', 'fk_p_249597_249596_questi_5c31fe5bf32c6')->references('id')->on('polls')->onDelete('cascade');
                $table->integer('question_id')->unsigned()->nullable();
                $table->foreign('question_id', 'fk_p_249596_249597_poll_q_5c31fe5bf334f')->references('id')->on('questions')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_question');
    }
}
