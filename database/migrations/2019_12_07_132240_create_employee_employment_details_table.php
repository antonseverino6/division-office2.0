<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeEmploymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_employment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_personal_detail_id');
            $table->string('employee_id')->unique();
            $table->string('role_type');
            $table->integer('employment_status_id');
            $table->string('job_code');
            $table->date('date_join');
            $table->date('date_appoint');
            $table->string('work_shift');
            $table->string('biometric')->nullable();
            $table->string('item_num');
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
        Schema::dropIfExists('employee_employment_details');
    }
}
