<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnsiteContestRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onsite_contest_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('onsite_contest_id');
            $table->string('realname');
            $table->string('sid')->nullable();
            $table->string('location1')->nullable();
            $table->string('location2')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'onsite_contest_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onsite_contest_registrations');
    }
}
