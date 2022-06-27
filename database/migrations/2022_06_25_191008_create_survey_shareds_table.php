<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveySharedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_shareds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('survey_id');
            $table->bigInteger('tenant_id');
            $table->bigInteger('contact_id');
            $table->bigInteger('status')->default(0)->comment('1=Participated,0=Not');
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
        Schema::dropIfExists('survey_shareds');
    }
}
