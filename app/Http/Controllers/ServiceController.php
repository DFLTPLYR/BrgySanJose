<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function Business(Request $request)
    {
        return Inertia::render('BusinessTypes');
    }
}
