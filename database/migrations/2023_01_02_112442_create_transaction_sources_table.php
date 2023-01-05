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
        Schema::create('transaction_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transactionid')->nullable();
            $table->string('sourceid')->nullable();
            $table->string('type')->nullable();
            $table->string('expiry_month')->nullable();
            $table->string('expiry_year')->nullable();
            $table->string('cardname')->nullable();
            $table->string('scheme')->nullable();
            $table->string('last4')->nullable();
            $table->string('fingerprint')->nullable();
            $table->string('bin')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_category')->nullable();
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
        Schema::dropIfExists('transaction_sources');
    }
};
