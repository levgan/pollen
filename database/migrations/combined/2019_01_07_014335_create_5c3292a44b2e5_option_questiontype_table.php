<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c3292a44b2e5OptionQuestiontypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('option_questiontype')) {
            Schema::create('option_questiontype', function (Blueprint $table) {
                $table->integer('option_id')->unsigned()->nullable();
                $table->foreign('option_id', 'fk_p_249594_249595_questi_5c3292a44b44b')->references('id')->on('options')->onDelete('cascade');
                $table->integer('questiontype_id')->unsigned()->nullable();
                $table->foreign('questiontype_id', 'fk_p_249595_249594_option_5c3292a44b558')->references('id')->on('questiontypes')->onDelete('cascade');
                
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
        Schema::dropIfExists('option_questiontype');
    }
}
