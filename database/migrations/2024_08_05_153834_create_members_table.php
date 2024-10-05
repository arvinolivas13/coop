<?php

use Illuminate\Support\Facades\Schema;
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
            $table->bigIncrements('id');
            $table->string('acc_no');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('nickname')->nullable();
            $table->text('address');
            $table->string('religion');
            $table->string('birthdate');
            $table->string('birthplace');
            $table->string('gender');
            $table->string('mobile_no');
            $table->string('email_address');
            $table->string('occupation');
            $table->string('civil_status');
            $table->string('spouse')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->string('no_children')->nullable();
            $table->string('mothers_name');
            $table->string('fathers_name');
            $table->string('company')->nullable();
            $table->string('company_phone_no')->nullable();
            $table->text('company_address')->nullable();
            $table->string('source_of_income');
            $table->string('monthly_income');
            $table->string('educational_attainment');
            $table->string('contact_person');
            $table->string('contact_person_no');
            $table->string('contact_person_address');
            $table->string('status');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->string('deleted_at')->nullable();
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
        Schema::dropIfExists('members');
    }
}
