<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarginReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('margin_reports', function (Blueprint $table) {
            $table->id();
            $table->double('debit')->default(0);
            $table->double('credit')->default(0);
            $table->integer('trans_type')->default(1)->comment('1=sales,2=payment');
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
        Schema::dropIfExists('margin_reports');
    }
}
