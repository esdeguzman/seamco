<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->boolean('approved');
            $table->text('disapproval_reason');
            $table->unsignedInteger('disapproved_by');
            $table->unsignedInteger('approved_by');
            $table->boolean('attended_pmes');
            $table->unsignedInteger('attendance_verified_by');
            $table->boolean('id_has_been_released');
            $table->unsignedInteger('id_released_by');
            $table->boolean('fees_informed');
            $table->unsignedInteger('fees_informed_by');
            $table->boolean('share_cert_given');
            $table->unsignedInteger('share_cert_given_by');
            $table->string('share_cert_release_date');
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
        Schema::dropIfExists('applications');
    }
}
