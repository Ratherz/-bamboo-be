<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\RoleUser;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;

class MigrateData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            ['name' => 'ไผ่ลำต้น'],
            ['name' => 'ไผ่หน่อ'],
            ['name' => 'ปุ๋ยสำหรับไผ่'],
            ['name' => 'รับจ้างตัดไผ่'],
            ['name' => 'รับจ้างขนส่ง'],
            ['name' => 'อาหาร'],
            ['name' => 'ไผ่แปรรูป'],
            ['name' => 'วัสดุ'],
            ['name' => 'เฟอร์นิเจอร์'],
            ['name' => 'เกษตร'],
            ['name' => 'สุขภาพ']
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
        $roles = [
            ['name' => 'admin', 'label' => 'ผู้ดูแลระบบ'],
            ['name' => 'BPS', 'label' => 'ผู้ปลูกไผ่(ขายหน่อ)'],
            ['name' => 'BPL', 'label' => 'ผู้ปลูกไผ่(ขายลำ)'],
            ['name' => 'BPF', 'label' => 'ผู้ปลูกไผ่(ผสมผสานกับสวนผลไม้อื่น)'],
            ['name' => 'BPA', 'label' => 'ผู้ปลูกไผ่(ผสมผสานและไผ่ตกแต่ง)'],
            ['name' => "CD", "label" => "ผู้รับจ้างตัดส่ง"],
            ['name' => "SME", "label" => "ผู้แปรรูปผลิตภัณฑ์"],
            ['name' => "BF", "label" => 'ผู้ประกอบการขายปุ๋ยสำหรับไผ่']
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        RoleUser::whereRaw("true = true")->delete();
        User::whereRaw('true = true')->delete();
        Role::whereRaw("true = true")->delete();
        Category::whereRaw("true = true")->delete();
    }
}
