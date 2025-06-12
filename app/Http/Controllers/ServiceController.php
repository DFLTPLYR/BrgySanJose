<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function Business(Request $request)
    {
        return Inertia::render('BusinessTypes');
    }

    public function sendMail(Request $request){

        $validated = $request->validateWithBag('sendEmailErrorBag', [
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        Mail::raw($validated['message'], function ($message) use ($validated) {
            $message->to(env('MAIL_FROM_ADDRESS'))
                    ->subject($validated['subject'])
                    ->from($validated['email'], $validated['name']);
        });

        return back()->with('success', 'Barangay clearance submitted successfully.');
    }

    public function destroy(Request $request,int $id){
        if(Auth::check() && $id){
            Clearance::destroy($id);
        }
        return redirect()->back();
    }
}
