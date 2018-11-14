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
            $table->dateTime('in_bed_at');
            $table->dateTime('until');
            $table->string('duration');
            $table->string('asleep');
            $table->string('time_awake_in_bed');
            $table->string('fell_asleep_in')->nullable();
            $table->string('quality_sleep')->nullable();
            $table->string('deep_sleep')->nullable();
            $table->string('heartrate')->nullable();
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
