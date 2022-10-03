<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPlaceController extends Controller
{
    public function index() {
        return 'this is my page';
    }

    public function city() {
        return 'Kazan';
    }

    public function hobby() {
        return 'Music';
    }
}
