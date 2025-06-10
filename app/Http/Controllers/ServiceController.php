<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function Barangay(){
        return Inertia::render('Services/Barangay');
    }
    public function Working(){
        return Inertia::render('Services/Working');
    }
    public function WaterElectrical(){
        return Inertia::render('Services/WaterElectrical');
    }
    public function FenceBuilding(){
        return Inertia::render('Services/FenceBuilding');
    }
    public function Business(){
        return Inertia::render('Services/Business');
    }
    public function Indigency(){
        return Inertia::render('Services/Indigency');
    }
}
