<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        return redirect()->route('admin.bills.index');
    }
}
