<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->tinyInteger('status')->nullable();
            $table->string('date_of_last_loan')->nullable();
            $table->string('date_of_last_payment')->nullable();
            $table->decimal('balance_of_last_loan', 20, 2)->nullable();
            $table->string('verified_by')->nullable();
            $table->string('recommended_for_loan_extension_by')->nullable();
            $table->string('approved_for_payment_by')->nullable();
            $table->string('estimated_date_release')->nullable();
            $table->decimal('approved_amount', 20, 2)->nullable();
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
        Schema::dropIfExists('credit_evaluations');
    }
}
