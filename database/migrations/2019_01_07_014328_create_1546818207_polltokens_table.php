<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1546818207PolltokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('polltokens')) {
            Schema::create('polltokens', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->string('description')->nullable();
                $table->string('token');
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('polltokens');
    }
}
