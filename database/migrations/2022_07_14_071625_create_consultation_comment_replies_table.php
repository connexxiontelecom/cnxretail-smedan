<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_comment_replies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('consultation_id');
            $table->bigInteger('consultation_comment_id');
            $table->bigInteger('replied_by');
            $table->integer('user_level')->default(1)->comment('1=Tenant,2=Admin');
            $table->text('reply')->nullable();
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
        Schema::dropIfExists('consultation_comment_replies');
    }
}
