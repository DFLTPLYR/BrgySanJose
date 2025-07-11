<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClearanceController extends Controller
{
    public function index()
    {
        return Inertia::render('Clearance/Index', [
            'Clearance' => Clearance::latest()
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'firstName' => $item->firstName,
                        'lastName' => $item->lastName,
                        'full_name' => $item->full_name,
                        'clearance_type' => $item->clearance_type,
                        'formatted_type' => $item->formatted_type,
                        'additional_data' => $item->additional_data,
                        'status' => $item->formatted_status,
                        'created_at' => $item->created_at,
                        'is_pending' => $item->status === 'Pending',
                        'is_approved' => $item->status === 'Completed',
                        'is_rejected' => $item->status === 'Reject',
                    ];
                }),
        ]);
    }

    public function updateStatus(Clearance $clearance, Request $request)
    {
        $request->validate([
            'status' => 'required|in:completed,pending,reject',
        ]);

        $status = match ($request->status) {
            'completed' => 'Completed',
            'pending' => 'Pending',
            'reject' => 'Reject',
            default => 'Pending',
        };

        $clearance->update(['status' => $status]);

        return redirect()->back();
    }

    public function destroy(Clearance $clearance)
    {
        $clearance->delete();

        return redirect()->back()->with('success', 'Clearance deleted successfully.');
    }
}
