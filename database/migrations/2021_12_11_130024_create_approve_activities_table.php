<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApproveActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approve_activities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->nullable();
            $table->integer('amount');
            $table->integer('earnings');
            $table->integer('due');
            $table->json('client_earnings');
            $table->date('date');
            $table->boolean('approved')->default(false);
            $table->date('approved_at')->nullable();

            $table->unsignedBigInteger('activity_type_id');
            //$table->foreign('approve_activity_type_id')->references('id')->on('activity_types')->onDelete('cascade');

            $table->unsignedBigInteger('loan_id');
            //$table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approve_activities');
    }
}
