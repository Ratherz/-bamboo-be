<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment("ไอดีผู้ใช้งาน");
            // $table->string('username')->comment("ชื่อผู้ใช้งาน");
            $table->string('email')->unique()->email('อีเมล์');
            $table->timestamp('email_verified_at')->nullable()->comment('การยืนยัน');
            $table->string('password')->nullable()->comment("รหัสผ่าน");
            $table->string('uid')->nullable()->comment('โซเชิยล');
            $table->rememberToken()->comment('โทเค่น');
            $table->string('line')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
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
        Schema::dropIfExists('users');
    }
}
