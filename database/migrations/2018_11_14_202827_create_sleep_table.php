<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSleepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sleep', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->dateTime('in_bed_at');
            $table->dateTime('until');
            $table->time('duration');
            $table->time('asleep');
            $table->time('time_awake_in_bed');
            $table->time('fell_asleep_in')->nullable();
            $table->time('quality_sleep')->nullable();
            $table->time('deep_sleep')->nullable();
            $table->integer('heartrate')->nullable();
            $table->string('tags')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sleep');
    }
}
