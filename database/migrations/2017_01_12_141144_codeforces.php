<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Codeforces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codeforces_contests', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name');
            $table->string('type');
            $table->string('phase');
            $table->string('frozen');
            $table->integer('durationSeconds');
            $table->integer('startTimeSeconds');
            $table->integer('relativeTimeSeconds');

            $table->primary('id');
        });
        Schema::create('codeforces_users', function (Blueprint $table) {
            $table->string('handle');
            $table->string('lastName')->nullable();
            $table->string('firstName')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('organization')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('rating');
            $table->string('rank');
            $table->integer('maxRating');
            $table->string('maxRank');
            $table->string('titlePhoto')->nullable();
            $table->integer('contribution')->nullable();
            $table->integer('friendOfCount')->nullable();
            $table->integer('registrationTimeSeconds');
            $table->integer('lastOnlineTimeSeconds');

            $table->primary('handle');
        });
        Schema::create('codeforces_statuses', function (Blueprint $table) {
            $table->integer('id');
            $table->string('handle');
            $table->integer('contestId');
            $table->string('index');
            $table->string('name');
            $table->string('testset');
            $table->string('verdict');
            $table->integer('passedTestCount');
            $table->string('programmingLanguage');
            $table->integer('timeConsumedMillis');
            $table->integer('memoryConsumedBytes');
            $table->integer('creationTimeSeconds');
            $table->integer('relativeTimeSeconds');

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codeforces_statuses');
        Schema::dropIfExists('codeforces_users');
        Schema::dropIfExists('codeforces_contests');
    }
}
