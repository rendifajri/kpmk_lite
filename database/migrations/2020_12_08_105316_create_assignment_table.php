<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('topic_id')->unsigned();
            $table->bigInteger('attachment_id')->unsigned();
            $table->integer('grade')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade');
            $table->foreign('topic_id')->references('id')->on('topic')->onUpdate('cascade');
            $table->foreign('attachment_id')->references('id')->on('attachment')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment');
    }
}
