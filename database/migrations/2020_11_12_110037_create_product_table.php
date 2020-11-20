<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->comment('ไอดี');
            $table->string('name', 100)->comment('ชื่อสินค้า');
            $table->double('price')->comment('ราคา(บาท)');
            $table->string('unit')->comment('หน่วย')->default('ชิ้น');
            $table->unsignedInteger('category_id')->nullable()->comment('หมวดหมู่สินค้า');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null')->onUpdate('cascade');
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
}
