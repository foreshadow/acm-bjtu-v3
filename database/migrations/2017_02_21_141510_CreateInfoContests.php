<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoContests extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('info_contests', function (Blueprint $table) {
            $table->integer('id');
            $table->string('oj');
            $table->string('link');
            $table->string('name');
            $table->timestamp('start_time');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('info_contests');
    }
}
