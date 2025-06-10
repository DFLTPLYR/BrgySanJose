<?php

namespace App\Http\Controllers;

use App\Models\clerance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function Barangay(){
        return Inertia::render('Services/Barangay');
    }

    public function SubmitClearanceForm(Request $request)
    {
        $request->validateWithBag('barangayClearanceErrorForm', [
                'lastName' => 'required|string|max:100',
                'firstName' => 'required|string|max:100',
                'middleName' => 'required|string|max:100',

                // Address Information
                'provincialAddress' => 'required|string|max:255',
                'yearsInTagaytay' => 'required|integer|min:0|max:120',
                'presentAddress' => 'required|string|max:255',

                // Contact Information
                'contactNumber' => 'required|numeric|digits_between:7,15',
                'email' => 'required|email|max:100',

                // Personal Details
                'civilStatus' => 'required|string|in:Single,Married,Widowed,Separated',
                'citizenship' => 'required|string|max:50',
                'birthdate' => 'required|date|before:-18 years',
                'birthplace' => 'required|string|max:100',
                'age' => 'required|integer|min:18|max:120',
                'personalAppearance' => 'required|boolean',

                // Occupation Information
                'occupation' => 'required|string|max:100',
                'companyName' => 'required|string|max:100',

                // Family Information
                'spouseName' => 'nullable|string|max:100',
                'spouseOccupation' => 'nullable|string|max:100',
                'fatherName' => 'required|string|max:100',
                'fatherOccupation' => 'nullable|string|max:100',
                'motherName' => 'required|string|max:100',
                'motherOccupation' => 'nullable|string|max:100',
                'validId' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
            ]);
            if ($request->hasFile('validId')) {
                $file = $request->file('validId');

                if (!Storage::disk('public')->exists('valid_ids')) {
                    Storage::disk('public')->makeDirectory('valid_ids');
                }
                $path = $request->file('validId')->store('valid_ids', 'public');

                $originalName = $file->getClientOriginalName();
            }

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
