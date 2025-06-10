<?php

namespace App\Http\Controllers;

use App\Models\clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ServiceController extends Controller
{
    // Clearance
    public function Barangay()
    {
        return Inertia::render('Services/Barangay');
    }

    public function SubmitClearanceForm(Request $request)
    {
        $validated = $request->validateWithBag('barangayClearanceErrorForm', [
            'lastName' => 'required|string|max:100',
            'firstName' => 'required|string|max:100',
            'middleName' => 'required|string|max:100',
            'provincialAddress' => 'required|string|max:255',
            'yearsInTagaytay' => 'required|integer|min:0|max:120',
            'presentAddress' => 'required|string|max:255',
            'contactNumber' => 'required|numeric|digits_between:7,15',
            'email' => 'required|email|max:100',
            'civilStatus' => 'required|string|in:Single,Married,Widowed,Separated',
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
            'validId' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $validIdPath = $request->file('validId')->store('valid_ids', 'public');

        // Create the clearance record
        Clearance::create([
            'clearance_type' => 'barangay_clearance',
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
                'validIdPath' => $validIdPath,
                'personalAppearance' => $validated['personalAppearance'],
            ],
        ]);

        return back()->with('success', 'Barangay clearance submitted successfully.');
    }

    // Working
    public function Working()
    {
        return Inertia::render('Services/Working');
    }

    public function SubmitWorkingForm(Request $request)
    {
        $validated = $request->validateWithBag('workingFormErrorForm', [
            'lastName' => 'required|string|max:100',
            'firstName' => 'required|string|max:100',
            'middleName' => 'required|string|max:100',
            'provincialAddress' => 'required|string|max:255',
            'yearsInTagaytay' => 'required|integer|min:0|max:120',
            'presentAddress' => 'required|string|max:255',
            'contactNumber' => 'required|numeric|digits_between:7,15',
            'email' => 'required|email|max:100',
            'civilStatus' => 'required|string|in:Single,Married,Widowed,Separated',
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
            'presentId' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $presentId = $request->file('presentId')->store('present_Id', 'public');

        Clearance::create([
            'clearance_type' => 'working_clearance',
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
                'presentId' => $presentId,
                'personalAppearance' => $validated['personalAppearance'],
            ],
        ]);

        Mail::send([], [], function ($message) use ($presentId) {
            $presentId = $message->embed(storage_path("app/public/{$presentId}"));
            $html = "
                <h1>Clearance Submitted</h1>
                <p>Attached visuals:</p>
                <p><strong>Land Title:</strong><br><img src='{$presentId}' style='max-width:500px;'></p>
            ";

            $message->to('gonzales.johncris01@gmail.com')
                ->from('barangaysanjose1938@gmail.com', 'Barangay San Jose')
                ->subject('Clearance Submission with Embedded Files')
                ->html($html);
        });

        return back()->with('success', 'Barangay clearance submitted successfully.');
    }

    // Bill
    public function WaterElectrical()
    {
        return Inertia::render('Services/WaterElectrical');
    }

    public function SubmitWaterElectricalForm(Request $request)
    {
        $validated = $request->validateWithBag('waterElectricalErrorForm', [
            'lastName' => 'required|string|max:100',
            'firstName' => 'required|string|max:100',
            'middleName' => 'required|string|max:100',
            'provincialAddress' => 'required|string|max:255',
            'yearsInTagaytay' => 'required|integer|min:0|max:120',
            'presentAddress' => 'required|string|max:255',
            'contactNumber' => 'required|numeric|digits_between:7,15',
            'email' => 'required|email|max:100',
            'civilStatus' => 'required|string|in:Single,Married,Widowed,Separated',
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
            'landTitle' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'latestPicture' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $landTitlePath = $request->file('landTitle')->store('land_titles', 'public');
        $latestPicture = $request->file('latestPicture')->store('latest_photos', 'public');

        Clearance::create([
            'clearance_type' => 'water_and_electrical_clearance',
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
                'landTitle' => $landTitlePath,
                'latestPhoto' => $latestPicture,
            ],
        ]);

        Mail::send([], [], function ($message) use ($landTitlePath, $latestPicture) {
            $landTitleCid = $message->embed(storage_path("app/public/{$landTitlePath}"));
            $latestPhotoCid = $message->embed(storage_path("app/public/{$latestPicture}"));

            $html = "
                <h1>Clearance Submitted</h1>
                <p>Attached visuals:</p>
                <p><strong>Land Title:</strong><br><img src='{$landTitleCid}' style='max-width:500px;'></p>
                <p><strong>Latest Photo:</strong><br><img src='{$latestPhotoCid}' style='max-width:500px;'></p>
            ";

            $message->to('gonzales.johncris01@gmail.com')
                ->from('barangaysanjose1938@gmail.com', 'Barangay San Jose')
                ->subject('Clearance Submission with Embedded Files')
                ->html($html);
        });

        return back()->with('success', 'Barangay clearance submitted successfully.');
    }

    // Fencing
    public function FenceBuilding()
    {
        return Inertia::render('Services/FenceBuilding');
    }

    public function SubmitFenceBuildingForm(Request $request)
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
                'civilStatus' => 'required|string|in:Single,Married,Widowed,Separated',
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

        Mail::send([], [], function ($message) use ($landTitlePath, $structureDesignPath, $latestPhotoPath, $employeeListPath) {
            $landTitleCid = $message->embed(storage_path("app/public/{$landTitlePath}"));
            $latestPhotoCid = $message->embed(storage_path("app/public/{$structureDesignPath}"));
            $structureDesignCid = $message->embed(storage_path("app/public/{$latestPhotoPath}"));
            $employeeListCid = $message->embed(storage_path("app/public/{$employeeListPath}"));
            $html = "
                <h1>Clearance Submitted</h1>
                <p>Attached visuals:</p>
                <p><strong>Land Title:</strong><br><img src='{$landTitleCid}' style='max-width:500px;'></p>
                <p><strong>Latest Photo:</strong><br><img src='{$latestPhotoCid}' style='max-width:500px;'></p>
                <p><strong>Latest Photo:</strong><br><img src='{$structureDesignCid}' style='max-width:500px;'></p>
                <p><strong>Latest Photo:</strong><br><img src='{$employeeListCid}' style='max-width:500px;'></p>
            ";

            $message->to('gonzales.johncris01@gmail.com')
                ->from('barangaysanjose1938@gmail.com', 'Barangay San Jose')
                ->subject('Clearance Submission with Embedded Files')
                ->html($html);
        });

        return back()->with('success', 'Barangay clearance submitted successfully.');
    }

    public function Business()
    {
        return Inertia::render('Services/Business');
    }

    // Indigency
    public function Indigency()
    {
        return Inertia::render('Services/Indigency');
    }

    public function SubmitIndigencyForm(Request $request)
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
            'civilStatus' => 'required|string|in:Single,Married,Widowed,Separated',
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
