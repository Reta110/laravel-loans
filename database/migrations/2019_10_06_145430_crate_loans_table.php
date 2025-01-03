<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateLoansTable extends Migration
{
  public function up()
  {
    Schema::create('loans', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->float('amount', 8, 2);
        $table->float('percent', 8, 2);
        $table->integer('dues');
        $table->boolean('finished')->nullable();
        $table->json('client_percents');
        $table->date('date');
        $table->date('expires_at');
        $table->text('observation')->nullable();

        $table->timestamps();
        $table->softDeletes();

        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        $table->unsignedBigInteger('client_id');
        $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
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
