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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('categorycode',20)->nullable();
            $table->string('title',250)->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('slider')->nullable();
            $table->string('slug',250)->nullable();
            $table->integer('order')->nullable();
            $table->boolean('isfeatured')->default('0');
            $table->nestedSet();
            $table->string('metatitle',250)->nullable();
            $table->string('metakeywords',250)->nullable();
            $table->string('metadescription',250)->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('visibility')->default(0)->nullable();
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
        Schema::dropIfExists('categories');
    }
};
