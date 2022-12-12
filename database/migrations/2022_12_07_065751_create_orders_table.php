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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->nullable();
            $table->bigInteger('userid')->nullable();
            $table->decimal('sub_total',10,2);
            $table->string('shipping_id')->nullable();
            $table->string('coupon')->nullable();
            $table->decimal('total_amount',10,2);
            $table->bigInteger('quantity')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('order_status')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('transactionid')->nullable();
            $table->decimal('tax',10,2)->nullable();
            $table->decimal('shipping_cost',10,2)->nullable();
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
        Schema::dropIfExists('orders');
    }
};
