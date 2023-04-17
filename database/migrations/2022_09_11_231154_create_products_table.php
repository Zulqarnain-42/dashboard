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
            $table->string('productcode',20)->nullable();
            $table->string('title',250)->nullable();
            $table->string('searchtitle',250)->nullable();
            $table->string('slug',250)->nullable();
            $table->longText('longdescription')->nullable();
            $table->longText('shortdescription')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('mfr',50)->nullable();
            $table->string('ean',50)->nullable();
            $table->string('upc',50)->nullable();
            $table->string('sku',50)->nullable();
            $table->string('length',50)->nullable();
            $table->string('width',50)->nullable();
            $table->string('height',50)->nullable();
            $table->string('weight',50)->nullable();
            $table->decimal('retailprice', 10, 2);
            $table->decimal('price', 10, 2);
            $table->boolean('status')->default(0);
            $table->boolean('visibility')->default(0)->nullable();
            $table->foreignId('brandid')->unsigned();
            $table->foreignId('brandcategoryid')->unsigned()->nullable();
            $table->foreignId('availabilityid')->unsigned()->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->longText('inthebox')->nullable();
            $table->longText('specifications')->nullable();
            $table->boolean('isfeatured')->default(0);
            $table->string('metatitle',250)->nullable();
            $table->string('metakeywords',250)->nullable();
            $table->string('metadescription',250)->nullable();
            $table->string('office_opening',250)->nullable();
            $table->string('hscode',250)->nullable();
            $table->string('warehouse_opening',250)->nullable();
            $table->bigInteger('addedby')->nullable();
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
