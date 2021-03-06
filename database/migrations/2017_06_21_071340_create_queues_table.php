<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appointment_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('queue_number');
            $table->enum('status', ['lock', 'available', 'on-going', 'completed']);
            $table->timestamp('started_time')->nullable();
            $table->timestamp('completed_time')->nullable();
            $table->enum('facility', ['consultation', 'laboratory', 'xray']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('appointment_id')
                ->references('id')
                ->on('appointments')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queues');
    }
}
