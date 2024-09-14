<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('loan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id');
            $table->integer('loan_request_id');
            $table->string('interest_rate');
            $table->string('penalty_rate');
            $table->string('date_avail');
            $table->string('first_payment');
            $table->string('due_date');
            $table->string('loan_amount');
            $table->string('total_interest');
            $table->string('net_proceeds');
            $table->string('weekly_payment');
            $table->string('penalty_amount');
            $table->string('processing_fee');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });

        Schema::create('loan_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id');
            $table->integer('loan_details_id');
            $table->string('date');
            $table->string('principal_amount');
            $table->string('interest_amount');
            $table->string('amount');
            $table->string('status');
            $table->string('approved_by')->nullable();
            $table->string('approved_date')->nullable();
            $table->timestamps();
        });
        
        Schema::create('loan_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id');
            $table->integer('loan_schedule_id');
            $table->string('date');
            $table->string('amount');
            $table->string('penalty');
            $table->string('received_by');
            $table->string('receipt_no');
            $table->string('loan_balance');
            $table->string('status');
            $table->timestamps();
        });
        
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id');
            $table->string('date');
            $table->text('particulars');
            $table->string('amount');
            $table->text('remarks')->nullable();
            $table->string('status');
            $table->string('audit_status')->default('draft');
            $table->string('audit_by')->nullable();
            $table->string('audit_date')->nullable();
            $table->text('audit_remarks')->nullable();
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
        Schema::dropIfExists('loan_schedules');
    }
}
