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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('project_id');
            $table->string('type');
            $table->string('billing_type');
            $table->string('empanelment');
            $table->string('value');
            $table->string('date');
            $table->string('validity_date');
            $table->string('milestones');
            // $table->string('milestone_date');
            // $table->string('milestone_amount');
            // $table->string('milestone_percent_amount');
            // $table->string('milestone_description');
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
        Schema::dropIfExists('work_orders');
    }
};
