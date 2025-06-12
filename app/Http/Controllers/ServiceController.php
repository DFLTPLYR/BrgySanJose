<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function Business(Request $request)
    {
        return Inertia::render('BusinessTypes');
    }
}
