<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id');
            $table->string('income_type');
            $table->string('income_amount');
            $table->string('payment_frequency');
            $table->string('no_of_payment');
            $table->string('loan_amount');
            $table->string('reference_name_1')->nullable();
            $table->string('reference_phone_1')->nullable();
            $table->string('reference_relationship_1')->nullable();
            $table->string('reference_name_2')->nullable();
            $table->string('reference_phone_2')->nullable();
            $table->string('reference_relationship_2')->nullable();
            $table->integer('co_maker_id');
            $table->string('status');
            $table->integer('approved_by')->nullable();
            $table->string('approved_date')->nullable();
            $table->integer('rejected_by')->nullable();
            $table->string('rejected_date')->nullable();
            $table->integer('released_by')->nullable();
            $table->string('released_date')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('loan_requests_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('loan_request_id');
            $table->string('loan_purpose');
            $table->string('amount');
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
        Schema::dropIfExists('loan_requests');
        Schema::dropIfExists('loan_requests_details');
    }
}
