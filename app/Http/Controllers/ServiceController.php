<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function Barangay(){
        return Inertia::render('Service/Barangay');
    }
    public function Working(){
        return Inertia::render('Service/Working');
    }
    public function WaterElectrical(){
        return Inertia::render('Service/WaterElectrical');
    }
    public function FenceBuilding(){
        return Inertia::render('Service/FenceBuilding');
    }
    public function Business(){
        return Inertia::render('Service/Business');
    }
    public function Indigency(){
        return Inertia::render('Service/Indigency');
    }
}
