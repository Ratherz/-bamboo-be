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
                ["name" => "หน้าแรก", "icon" => "fas fa-home", "url" => "/"],
                ["name" => "ผู้ประกอบการ", "icon" => "fas fa-street-view" , "url" => "/operator"]
            ]
        ],
        [
            "name" => "จัดการ",
            "icon" => "fas fa-edit",
            "url" => "/admin",
            "sublist" => [
                ["name" => "สินค้า/ผลิตภัณฑ์", "icon" => "fas fa-shopping-bag", "url" => "/products"],
                ["name" => "ผู้ใช้งาน", "icon" => "fas fa-user", "url" => "/users"],
                ["name" => "บทบาท", "icon" => "fas fa-lock", "url" => "/roles"],
                ["name" => "หมวดหมู่สินค้า", "icon" => "fas fa-lock", "url" => "/categories"],
                ["name" => "เพิ่มโพสต์กิจกรรม", "icon" => "far fa-newspaper", "url" => "/activity"],
            ]
        ],
        [   "name" => "ร้านค้า", "icon" => "fas fa-shopping-cart" , "url" => "/shop"]

        //https://colorlib.com/polygon/cooladmin/index.html
    ];

    public static $SideMenuUser = [
        [
            "name" => "แดชบอร์ด",
            "icon" => "fas fa-tachometer-alt",
            "url" => "/admin",
            "sublist" => [
                ["name" => "หน้าแรก", "icon" => "fas fa-home", "url" => "/"],
                ["name" => "ผู้ประกอบการ", "icon" => "fas fa-street-view" , "url" => "/operator"]
            ]
        ],
        [
            "name" => "จัดการ",
            "icon" => "fas fa-edit",
            "url" => "/admin",
            "sublist" => [
                ["name" => "สินค้า/ผลิตภัณฑ์", "icon" => "fas fa-shopping-bag", "url" => "/products"],
                ["name" => "เพิ่มโพสต์กิจกรรม", "icon" => "far fa-newspaper", "url" => "/activity"],
            ]
        ],
        [
            "name" => "ตั้งค่าโปรไฟล์",
            "icon" => "fas fa-cog",
            "url" => "/admin",
            "sublist" => [
                ["name" => "ตั้งค่าโปรไฟล์ของฉัน", "icon" => "fas fa-user", "url" => "/setting-profile"],
                ["name" => "ตั้งค่าโปรไฟล์ของร้าน", "icon" => "fas fa-shopping-cart", "url" => "/setting-shop"],
            ]
        ],
        [   "name" => "ร้านค้า", "icon" => "fas fa-shopping-cart" , "url" => "/shop"]

        //https://colorlib.com/polygon/cooladmin/index.html
    ];
}
