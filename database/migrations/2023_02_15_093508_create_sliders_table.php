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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('imageone')->nullable();
            $table->string('imagetwo')->nullable();
            $table->string('paragraphone')->nullable();
            $table->string('paragraphtwo')->nullable();
            $table->string('paragraphthree')->nullable();
            $table->string('slug')->nullable();
            $table->string('buttontext')->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('addedby')->unsigned()->nullable();
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
        Schema::dropIfExists('sliders');
    }
};
