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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productcode')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('longdescription')->nullable();
            $table->longText('shortdescription')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('mfr')->nullable();
            $table->string('upc')->nullable();
            $table->string('sku')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('status')->default(0);
            $table->boolean('visibility')->default(0);
            $table->foreignId('brandid')->unsigned();
            $table->foreignId('availabilityid')->unsigned();
            $table->longText('inthebox')->nullable();
            $table->longText('specifications')->nullable();
            $table->string('lensmounttype')->nullable();
            $table->string('displaysize')->nullable();
            $table->string('videoresolution')->nullable();
            $table->string('cardtype')->nullable();
            $table->string('digitalinterface')->nullable();
            $table->string('metatitle')->nullable();
            $table->string('metakeywords')->nullable();
            $table->string('metadescription')->nullable();
            $table->string('isfeaturedvideo')->default(0);
            $table->string('isfeaturedphoto')->default(0);
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
        Schema::dropIfExists('products');
    }
};
