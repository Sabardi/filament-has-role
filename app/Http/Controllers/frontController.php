<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class frontController extends Controller
{
    public function index()
    {
        $jobs = Pekerjaan::with('kategoris')->get();
        return view('dashboard', compact('jobs'));
    }
}
