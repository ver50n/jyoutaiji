<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('uniq');
            $table->string('type')->default('open');
            $table->string('category');
            $table->string('name');
            $table->string('poster')->nullable();
            $table->string('navigator');
            $table->text('location');
            $table->integer('cost')->default(0);
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->string('short_desc')->nullable();
            $table->text('desc')->nullable();
            $table->string('schedule_qr')->nullable();
            $table->integer('participant_limit')->default(0);
            $table->integer('is_for_member_only')->default(0);
            $table->integer('is_auto_approve')->default(0);
            $table->tinyInteger('is_active')->default('0');
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
        Schema::dropIfExists('schedules');
    }
}
