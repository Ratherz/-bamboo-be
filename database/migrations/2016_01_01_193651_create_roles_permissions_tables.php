<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPermissionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->comment('ไอดีบทบาท');
            $table->string('name')->comment('บทบาท(ภาษาอังกฤษ)');
            $table->string('label')->nullable()->comment('บทบาท(คำอธิบาย)');
            $table->timestamps();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedInteger('role_id')->comment('บทบาท');
            $table->unsignedInteger('user_id')->comment('ผู้ใช้งาน');
            $table->timestamps();
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->primary(['role_id', 'user_id']);
        });
        $hash = password_hash('123456', PASSWORD_DEFAULT);
        App\Models\User::create(['password' => $hash, 'email' => 'super@admin.com']);
        App\Models\Role::create(['name' => 'admin', 'label' => "ผู้ดูแลระบบ"]);
        App\Models\RoleUser::create(['role_id' => 1, 'user_id' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}
