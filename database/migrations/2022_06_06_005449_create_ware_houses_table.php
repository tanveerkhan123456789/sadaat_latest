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
        Schema::create('ware_houses', function (Blueprint $table) {
            $table->id();
            $table->string('wareh_name');
            $table->string('wareh_email')->unique();
            $table->string('wareh_phone');
            $table->longText('wareh_address')->nullable();
            $table->string('wareh_stock')->default('0');
            $table->string('wareh_quantiy')->default('0');
            $table->tinyInteger('wareh_status')->default('0');
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
        Schema::dropIfExists('ware_houses');
    }
};
