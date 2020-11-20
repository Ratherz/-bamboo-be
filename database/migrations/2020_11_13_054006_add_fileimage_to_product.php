<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileimageToProduct extends Migration
{

    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('file_image')->comment('รูปสินค้า')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('user_id')->nullable()->comment('เจ้าของ');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_user_id_foreign');
            $table->dropColumn('file_image');
            $table->dropColumn('user_id');
            $table->dropColumn('description');
        });
    }
}
