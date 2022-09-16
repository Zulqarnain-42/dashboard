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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('inventorycode')->nullable();
            $table->integer('sharjahquantity')->default(0);
            $table->integer('officequantity')->default(0);
            $table->integer('fromofficetosharjah')->default(0);
            $table->integer('fromsharhjahtooffice')->default(0);
            $table->string('bookingdate')->nullable();
            $table->string('location')->nullable();
            $table->integer('bookedquantityfromwarehouse')->default(0);
            $table->integer('bookedquantityfromoffice')->default(0);
            $table->integer('salequantityfromwarehouse')->default(0);
            $table->integer('salequantityfromoffice')->default(0);
            $table->bigInteger('userid')->nullable();
            $table->string('bookedby')->nullable();
            $table->string('receipt')->nullable();
            $table->date('addedat');
            $table->foreignId('product_id')->unsigned();
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
        Schema::dropIfExists('inventories');
    }
};
