<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Clearance;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndigencyClearance extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');

        return Inertia::render('Services/Indigency', ['clearanceForm' => $id ? Clearance::findOrFail($id) : null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validateWithBag('indigencyErrorForm', [
            'lastName' => 'required|string|max:100',
            'firstName' => 'required|string|max:100',
            'middleName' => 'required|string|max:100',
            'provincialAddress' => 'required|string|max:255',
            'yearsInTagaytay' => 'required|integer|min:0|max:120',
            'presentAddress' => 'required|string|max:255',
            'contactNumber' => 'required|numeric|digits_between:7,15',
            'email' => 'required|email|max:100',
            'civilStatus' => 'required|string|in:Single,Married,Widowed',
            'citizenship' => 'required|string|max:50',
            'birthdate' => 'required|date|before:-18 years',
            'birthplace' => 'required|string|max:100',
            'age' => 'required|integer|min:18|max:120',
            'occupation' => 'required|string|max:100',
            'companyName' => 'required|string|max:100',
            'spouseName' => 'nullable|string|max:100',
            'spouseOccupation' => 'nullable|string|max:100',
            'fatherName' => 'required|string|max:100',
            'fatherOccupation' => 'nullable|string|max:100',
            'motherName' => 'required|string|max:100',
            'motherOccupation' => 'nullable|string|max:100',
            'medicalAbstract' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'medicalBill' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $medicalAbstract = $request->file('medicalAbstract')->store('medicals', 'public');
        $medicalBill = $request->file('medicalBill')->store('medicals', 'public');

        Clearance::create([
            'clearance_type' => 'indigency_clearance',
            'firstName' => $validated['firstName'],
            'lastName' => $validated['lastName'],
            'middleName' => $validated['middleName'],
            'provincialAddress' => $validated['provincialAddress'],
            'yearsInTagaytay' => $validated['yearsInTagaytay'],
            'presentAddress' => $validated['presentAddress'],
            'contactNumber' => $validated['contactNumber'],
            'civilStatus' => $validated['civilStatus'],
            'citizenship' => $validated['citizenship'],
            'birthdate' => $validated['birthdate'],
            'birthplace' => $validated['birthplace'],
            'age' => $validated['age'],
            'occupation' => $validated['occupation'],
            'companyName' => $validated['companyName'],
            'spouseName' => $validated['spouseName'] ?? null,
            'spouseOccupation' => $validated['spouseOccupation'] ?? null,
            'fatherName' => $validated['fatherName'],
            'fatherOccupation' => $validated['fatherOccupation'] ?? null,
            'motherName' => $validated['motherName'],
            'motherOccupation' => $validated['motherOccupation'] ?? null,
            'additional_data' => [
                'email' => $validated['email'],
                'medicalAbstract' => $medicalAbstract,
                'medicalBill' => $medicalBill,
            ],
        ]);

        return back()->with('success', 'Barangay clearance submitted successfully.');
    }
}
