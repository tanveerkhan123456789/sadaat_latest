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
            $table->string('product_name')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_img')->nullable();
            $table->string('product_unit')->nullable();
            $table->string('product_sale_unit')->nullable();
            $table->string('product_purchase_unit')->nullable();
            $table->string('product_brand')->nullable();
            $table->string('product_catagory')->nullable();
            $table->string('product_cost')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_method')->nullable();
            $table->string('product_feature')->default('NO');
            $table->string('product_different_warehouse')->default('NO');
            $table->string('product_add_warehouse')->default('NO');
            $table->longText('product_detail')->nullable();
            $table->string('product_warehouse')->nullable();
            $table->string('product_warehouse_price')->default('0');
            $table->string('product_promotional_price')->default('0');
            $table->string('product_promotional_start')->nullable();
            $table->string('product_promotional_end')->nullable();
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
