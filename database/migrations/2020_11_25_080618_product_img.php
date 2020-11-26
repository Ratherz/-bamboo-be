<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductImg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_img', function (Blueprint $table) {
            $table->increments('id')->comment('ไอดี');
            $table->string('path', 100)->comment('path');
            $table->unsignedInteger('product')->comment('ไอดีสินค้า');
            $table->timestamps();
            $table->foreign('product')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_img');
    }
    
}
