<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShopToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('shop_name', 250)->nullable()->comment("ชื่อร้าน/สถานประกอบการ");
            $table->double('lat')->nullable()->comment("พิกัดละติจูด");
            $table->double('lng')->nullable()->comment("พิกัดลองติจูด");
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('shop_name');
            $table->dropColumn('lat');
            $table->dropColumn('lng');
        });
    }
}
