<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c3292a30f4c6RelationshipsToPolltokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polltokens', function(Blueprint $table) {
            if (!Schema::hasColumn('polltokens', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '249764_5c3292a16612c')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('polltokens', 'poll_id')) {
                $table->integer('poll_id')->unsigned()->nullable();
                $table->foreign('poll_id', '249764_5c3292a17a270')->references('id')->on('polls')->onDelete('cascade');
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
        Schema::table('polltokens', function(Blueprint $table) {
            
        });
    }
}
