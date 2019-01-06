<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c31fc49658fbRelationshipsToResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responses', function(Blueprint $table) {
            if (!Schema::hasColumn('responses', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '249601_5c31fc472bcae')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('responses', 'question_id')) {
                $table->integer('question_id')->unsigned()->nullable();
                $table->foreign('question_id', '249601_5c31fc47434ed')->references('id')->on('questions')->onDelete('cascade');
                }
                if (!Schema::hasColumn('responses', 'option_id')) {
                $table->integer('option_id')->unsigned()->nullable();
                $table->foreign('option_id', '249601_5c31fc476597a')->references('id')->on('options')->onDelete('cascade');
                }
                if (!Schema::hasColumn('responses', 'poll_id')) {
                $table->integer('poll_id')->unsigned()->nullable();
                $table->foreign('poll_id', '249601_5c31fc477d7dc')->references('id')->on('polls')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responses', function(Blueprint $table) {
            
        });
    }
}
