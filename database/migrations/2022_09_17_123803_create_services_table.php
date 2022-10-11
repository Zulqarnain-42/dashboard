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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('joborder')->nullable();
            $table->string('arrivingdate')->nullable();
            $table->bigInteger('userid')->nullable();
            $table->string('customername')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('comments')->nullable();
            $table->longText('includes')->nullable();
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
        Schema::dropIfExists('services');
    }
};
