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
            $table->boolean('approved')->nullable();
            $table->text('disapproval_reason')->nullable();
            $table->unsignedInteger('disapproved_by')->nullable();
            $table->unsignedInteger('approved_by')->nullable();
            $table->boolean('attended_pmes')->nullable();
            $table->unsignedInteger('attendance_verified_by')->nullable();
            $table->boolean('id_has_been_released')->nullable();
            $table->unsignedInteger('id_released_by')->nullable();
            $table->boolean('fees_informed')->nullable();
            $table->unsignedInteger('fees_informed_by')->nullable();
            $table->boolean('share_cert_given')->nullable();
            $table->unsignedInteger('share_cert_given_by')->nullable();
            $table->string('share_cert_release_date')->nullable();
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
