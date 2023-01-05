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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->nullable();
            $table->string('action_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->boolean('approves_status')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('auth_code')->nullable();
            $table->string('response_code')->nullable();
            $table->string('response_summary')->nullable();
            $table->string('processed_on')->nullable();
            $table->string('reference')->nullable();
            $table->string('scheme_id')->nullable();
            $table->string('expires_on')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
