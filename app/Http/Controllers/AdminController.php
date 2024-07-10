<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the admin panel view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin_panel');
    }
}
