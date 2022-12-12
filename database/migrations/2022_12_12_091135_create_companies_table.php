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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_logo')->nullable();
            $table->string('company_logo2')->nullable();
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('workinghours')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('facebooklink')->nullable();
            $table->string('twitterlink')->nullable();
            $table->string('youtubelink')->nullable();
            $table->string('instagramlink')->nullable();
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
        Schema::dropIfExists('companies');
    }
};
