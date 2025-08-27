<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        // web.phpで決めたnameを指定
        return view('folders/create');
    }
}
