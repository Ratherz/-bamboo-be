<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $title = "หน้าแดชบอร์ด";
        return view('admin.dashboard', compact('title'));
    }
}
