<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_code')->nullable();
            $table->string('track_id')->nullable();
            $table->date('month')->nullable();
            $table->string('amount')->nullable();
            $table->text('description')->nullable();
            $table->string('session')->nullable();
            $table->string('term')->nullable();
            $table->string('payee')->nullable();
            $table->string('paid_to')->nullable();
            $table->string('status')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('salaries');
    }
}
