<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserAddActiveColumn extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->tinyInteger('activate')->default(0)->comment('เปิดใช้งาน');
            $table->text('file_image')->nullable()->comment('รูปภาพ');
            $table->string('first_name', 100)->nullable()->comment('ชื่อ');
            $table->string('last_name', 100)->nullable()->comment('สกุล');
            $table->string('phone', 15)->nullable()->comment('เบอร์');
            $table->string('address', 200)->nullable()->comment('ที่อยู่');
            $table->string('address_no', 5)->nullable()->comment('หมู่ที่');
            $table->string('zoi', 100)->nullable()->comment('ซอย');
            $table->string('road', 100)->nullable()->comment('ถนน');
            $table->string('district', 100)->nullable()->comment('ตำบล');
            $table->string('amphure', 100)->nullable()->comment('อำเภอ');
            $table->string('province', 100)->nullable()->comment('จังหวัด');
            $table->string('zip', 10)->nullable()->comment('รหัสไปรษณีย์');
            $table->string('firebase_uid')->nullable()->comment('ไอดีจากไฟร์เบส', 500);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('activate');
            $table->dropColumn('file_image');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('address_no');
            $table->dropColumn('zoi');
            $table->dropColumn('road');
            $table->dropColumn('district');
            $table->dropColumn('amphure');
            $table->dropColumn('province');
            $table->dropColumn('zip');
            // $table->dropColumn('firebase_uid');
        });
    }
}
