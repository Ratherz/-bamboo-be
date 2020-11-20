<?php

namespace App\Models;

class SiteInfo
{
    public static $SideMenu = [
        [
            "name" => "แดชบอร์ด",
            "icon" => "fas fa-tachometer-alt",
            "url" => "/admin",
            "sublist" => [
                ["name" => "หน้าแรก", "icon" => "fas fa-home", "url" => "/"]
            ]
        ],
        [
            "name" => "จัดการ",
            "icon" => "fas fa-tachometer-alt",
            "url" => "/admin",
            "sublist" => [
                ["name" => "สินค้า/ผลิตภัณฑ์", "icon" => "fas fa-shopping-bag", "url" => "/products"],
                ["name" => "ผู้ใช้งาน", "icon" => "fas fa-user", "url" => "/users"],
                ["name" => "บทบาท", "icon" => "fas fa-lock", "url" => "/roles"],
                ["name" => "หมวดหมู่สินค้า", "icon" => "fas fa-lock", "url" => "/categories"],
                ["name" => "เพิ่มโพสต์กิจกรรม", "icon" => "far fa-newspaper", "url" => "/activity"],
            ]
        ],
        ["name" => "CoolAdmin", "icon" => "fa fa-link", "url" => "https://colorlib.com/polygon/cooladmin/index.html"],
        ["name" => "ตัวช่วยสร้าง", "icon" => "fas fa-desktop", "url" => "/generator"]
        //https://colorlib.com/polygon/cooladmin/index.html
    ];
}
