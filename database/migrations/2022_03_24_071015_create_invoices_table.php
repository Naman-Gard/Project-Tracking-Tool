<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('work_order_number');
            $table->string('project_id');
            $table->string('reference_milestone_no');
            $table->string('date');
            $table->string('invoice_price');
            $table->string('amount_tax');
            $table->string('invoice_total_amount');
            $table->string('payment_due_date');
            $table->string('recieved_price');
            $table->string('payment_tax');
            $table->string('recieved_total_amount');
            $table->string('payment_recieved_date');
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
        Schema::dropIfExists('invoices');
    }
};
