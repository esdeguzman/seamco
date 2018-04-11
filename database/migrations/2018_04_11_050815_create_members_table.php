<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('photo')->nullable();
            $table->string('civil_status');
            $table->string('birth_date');
            $table->string('mobile_number');
            $table->string('gender');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->string('employer');
            $table->string('tax_identification_number');
            $table->string('position');
            $table->string('department');
            $table->string('employment_date');
            $table->decimal('salary', 12, 2);
            $table->text('employer_address');
            $table->string('other_source_of_income')->nullable();
            $table->unsignedSmallInteger('number_of_dependents');
            $table->string('username');
            $table->string('password');
            $table->string('code')->nullable();
            $table->string('email')->unique()->nullable();
            $table->dateTime('joined')->nullable();
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
        Schema::drop('members');
    }
}
