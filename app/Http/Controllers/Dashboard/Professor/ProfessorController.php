<?php

namespace App\Http\Controllers\Dashboard\Professor;

use App\Http\Controllers\Controller;


class ProfessorController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard-prof');

    }
}
