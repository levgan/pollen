<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c31fa5ae1ea9OptionQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('option_question')) {
            Schema::create('option_question', function (Blueprint $table) {
                $table->integer('option_id')->unsigned()->nullable();
                $table->foreign('option_id', 'fk_p_249594_249596_questi_5c31fa5ae1fe1')->references('id')->on('options')->onDelete('cascade');
                $table->integer('question_id')->unsigned()->nullable();
                $table->foreign('question_id', 'fk_p_249596_249594_option_5c31fa5ae206f')->references('id')->on('questions')->onDelete('cascade');
                
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
        Schema::dropIfExists('option_question');
    }
}
