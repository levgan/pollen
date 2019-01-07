<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c32975ea04a2QuestionQuestiontypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('question_questiontype')) {
            Schema::create('question_questiontype', function (Blueprint $table) {
                $table->integer('question_id')->unsigned()->nullable();
                $table->foreign('question_id', 'fk_p_249596_249595_questi_5c32975ea05c1')->references('id')->on('questions')->onDelete('cascade');
                $table->integer('questiontype_id')->unsigned()->nullable();
                $table->foreign('questiontype_id', 'fk_p_249595_249596_questi_5c32975ea0681')->references('id')->on('questiontypes')->onDelete('cascade');
                
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
        Schema::dropIfExists('question_questiontype');
    }
}
