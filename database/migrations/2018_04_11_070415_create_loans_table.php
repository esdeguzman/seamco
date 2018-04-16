<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('credit_evaluation_id')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->decimal('regular', 20, 2)->default('0.0');
            $table->decimal('short_term', 20, 2)->default('0.0');
            $table->decimal('pre_joining', 20, 2)->default('0.0');
            $table->decimal('productive', 20, 2)->default('0.0');
            $table->decimal('special', 20, 2)->default('0.0');
            $table->decimal('appliance', 20, 2)->default('0.0');
            $table->decimal('petty_cash', 20, 2)->default('0.0');
            $table->tinyInteger('payment_terms');
            $table->string('company_contact_number');
            $table->string('monthly_income');
            $table->string('take_home_pay');
            $table->string('sss_gsis');
            $table->string('residence_telephone_number');
            $table->unsignedInteger('total_amount');
            $table->string('remarks');
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
        Schema::dropIfExists('loans');
    }
}
