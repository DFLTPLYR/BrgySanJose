<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Mail\ClearanceCopy;
use App\Mail\ClearanceMail;
use App\Models\Clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class FencingClearance extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');

        return Inertia::render('Services/FenceBuilding', ['clearanceForm' => $id ? Clearance::findOrFail($id) : null]);
    }

    public function store(Request $request)
    {

        $validated = $request->validateWithBag('fenceBuildingErrorForm',
            [
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
                'personalAppearance' => 'required|boolean',
                'occupation' => 'required|string|max:100',
                'companyName' => 'required|string|max:100',
                'spouseName' => 'nullable|string|max:100',
                'spouseOccupation' => 'nullable|string|max:100',
                'fatherName' => 'required|string|max:100',
                'fatherOccupation' => 'nullable|string|max:100',
                'motherName' => 'required|string|max:100',
                'motherOccupation' => 'nullable|string|max:100',
                'landTitle' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'structureDesign' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'latestPhoto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'employeeList' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

        DB::transaction(function () use ($validated, $request) {
            $landTitlePath = $request->file('landTitle')->store('land_titles', 'public');
            $structureDesignPath = $request->file('structureDesign')->store('structure_designs', 'public');
            $latestPhotoPath = $request->file('latestPhoto')->store('latest_photos', 'public');
            $employeeListPath = $request->file('employeeList')->store('employee_lists', 'public');

            // Create the clearance record
            Clearance::create([
                'clearance_type' => 'fencing_clearance',
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
                    'personalAppearance' => $validated['personalAppearance'],
                    'landTitle' => $landTitlePath,
                    'structureDesign' => $structureDesignPath,
                    'latestPhoto' => $latestPhotoPath,
                    'employeeList' => $employeeListPath,
                ],
            ]);

            $embeddedImages = [
                'landTitlePath' => storage_path("app/public/{$landTitlePath}"),
                'structureDesignPath' => storage_path("app/public/{$structureDesignPath}"),
                'latestPhotoPath' => storage_path("app/public/{$latestPhotoPath}"),
                'employeeListPath' => storage_path("app/public/{$employeeListPath}"),
            ];
            $receiver = $validated['firstName'].' '.$validated['lastName'];
            $clearanceType = 'Fencing Clearance';

            // Send the email
            Mail::to($validated['email'])->send(new ClearanceMail($embeddedImages, $receiver, $clearanceType));
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ClearanceCopy($embeddedImages, $receiver, $clearanceType));
        });

        return back()->with('success', 'Barangay clearance submitted successfully.');
    }
}
