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
        Schema::create('user_gmail_login', function (Blueprint $table) {
            $table->id();
            $table->string('email_id');
            $table->string('role');
            $table->text('view')->nullable();
            $table->text('add')->nullable();
            $table->text('edit')->nullable();
            $table->text('delete')->nullable();
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
        Schema::dropIfExists('user_gmail_login');
    }
};
