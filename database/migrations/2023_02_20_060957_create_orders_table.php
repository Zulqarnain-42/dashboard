<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('order_code')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('company_name')->nullable();
            $table->string('billing_name')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_provice')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_postalcode')->nullable();
            $table->string('session_id')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('billing_discount')->nullable();
            $table->string('billing_discount_code')->nullable();
            $table->integer('billing_subtotal')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('total')->nullable();
            $table->boolean('shipped')->default(false);
            $table->string('payment_status')->nullable();
            $table->string('error')->nullable();
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
}
