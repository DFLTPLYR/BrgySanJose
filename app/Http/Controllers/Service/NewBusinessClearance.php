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

class NewBusinessClearance extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');

        return Inertia::render('Services/Business', ['clearanceForm' => $id ? Clearance::findOrFail($id) : null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validateWithBag('BusinessNewErrorForm', [
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
            'latestPhoto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dtiSec' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'contractLease' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'sketchBusiness' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'listEmployee' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        DB::transaction(function () use ($validated, $request) {
            $latestPhoto = $request->file('latestPhoto')->store('latest_photos', 'public');
            $dtiSec = $request->file('dtiSec')->store('dtiSec', 'public');
            $contractLease = $request->file('contractLease')->store('contractLease', 'public');
            $sketchBusiness = $request->file('sketchBusiness')->store('sketchBusiness', 'public');
            $listEmployee = $request->file('listEmployee')->store('listEmployee', 'public');
            $embeddedImages = [
                'latestPhoto' => storage_path("app/public/{$latestPhoto}"),
                'dtiSec' => storage_path("app/public/{$dtiSec}"),
                'contractLease' => storage_path("app/public/{$contractLease}"),
                'sketchBusiness' => storage_path("app/public/{$sketchBusiness}"),
                'listEmployee' => storage_path("app/public/{$listEmployee}"),
            ];
            Clearance::create([
                'clearance_type' => 'business_clearance',
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
                    'latestPhoto' => $latestPhoto,
                    'dtiSec' => $dtiSec,
                    'contractLease' => $contractLease,
                    'sketchBusiness' => $sketchBusiness,
                    'listEmployee' => $listEmployee,
                    'business_clearance_type' => 'new',
                ],
            ]);
            $receiver = $validated['firstName'].' '.$validated['lastName'];
            $clearanceType = 'New Business Clearance';

            // Send the email
            Mail::to($validated['email'])->send(new ClearanceMail($embeddedImages, $receiver, $clearanceType));
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ClearanceCopy($embeddedImages, $receiver, $clearanceType));
        });

        return back()->with('success', 'Barangay clearance submitted successfully.');
    }
}
