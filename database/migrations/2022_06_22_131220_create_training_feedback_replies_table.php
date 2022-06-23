<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingFeedbackRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_feedback_replies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('training_id');
            $table->bigInteger('training_feedback_id');
            $table->bigInteger('replied_by');
            $table->integer('user_level')->default(1)->comment('1=Admin,2=Tenant');
            $table->text('feedback_reply')->nullable();
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
        Schema::dropIfExists('training_feedback_replies');
    }
}
