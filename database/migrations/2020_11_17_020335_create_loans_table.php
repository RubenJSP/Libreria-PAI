<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nulleable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('book_id')->nulleable();
            $table->foreign('book_id')->references('id')->on('books');
            $table->date('loan_date')->default(\Carbon\Carbon::now());
            $table->date('return_date')->default(\Carbon\Carbon::now());
            $table->boolean('state')->default(false);
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
        Schema::dropIfExists('loans');
    }
}
