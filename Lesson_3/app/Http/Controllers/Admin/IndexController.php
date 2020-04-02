<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\NewsController;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function index() {
        return view('admin.index', [
            'login' => Auth::user()->name,
        ]);
    }
}
