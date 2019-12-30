<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoreEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('more_employee_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('employee_personal_detail_id')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_occ')->nullable();
            $table->string('spouse_add')->nullable();
            $table->string('spouse_phone')->nullable();
            $table->unsignedInteger('type_of_employee_id');
            $table->unsignedInteger('employee_base_id');
            $table->unsignedInteger('position_id');
            $table->unsignedInteger('subject_id')->nullable();
            $table->unsignedInteger('area_id')->nullable();
            $table->unsignedInteger('component_id')->nullable();
            $table->unsignedInteger('grade_level_id')->nullable();
            $table->unsignedInteger('levels_of_civil_id')->nullable();
            $table->string('tin_num')->nullable();
            $table->string('pag_ibig_num')->nullable();
            $table->string('gsis_bp_num')->nullable();
            $table->string('philhealth_num')->nullable();
            $table->string('lbp_num')->nullable();
            $table->string('prc_license')->nullable();
            $table->string('highest_grade_degree_rec')->nullable();
            $table->string('year_received')->nullable();
            $table->string('institution_name')->nullable();
            $table->string('spec_qualification')->nullable();
            $table->string('previous_experience')->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_relationship')->nullable();
            $table->string('emergency_address')->nullable();
            $table->string('emergency_phone')->nullable();
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
        Schema::dropIfExists('more_employee_details');
    }
}
