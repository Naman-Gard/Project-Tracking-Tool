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
        Schema::create('instruments', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no');
            $table->string('project_id');
            $table->string('type');
            $table->string('purpose');
            $table->string('reference_number');
            $table->string('amount');
            $table->string('date');
            $table->string('expiry_date');
            $table->string('submission_date');
            $table->string('maturity_date');
            $table->string('acknowledgement_date');
            $table->string('acknowledge_by');
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
        Schema::dropIfExists('instruments');
    }
};
