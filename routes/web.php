<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Http\Controllers\ClearanceController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/news-and-events', function () {
    return Inertia::render('NewsAndEvents');
})->name('news-and-events');

Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
})->name('about-us');

// ADD THIS: GET route for showing the registration form
Route::get('/register', function () {
    return Inertia::render('Register');
})->name('register');

// Your existing POST route for processing registration
Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Generate unique username from email
    $baseUsername = explode('@', $validated['email'])[0];
    $username = $baseUsername;
    $counter = 1;

    while (User::where('username', $username)->exists()) {
        $username = $baseUsername . $counter;
        $counter++;
    }

    $userData = [
        'name' => $validated['name'],
        'username' => $username,
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'status' => 'pending',
    ];

    $user = User::create($userData);

    return redirect()->route('login')->with('success', 'Registration submitted! Wait for admin approval.');
})->name('register.store');

Route::put('/user/{user}/status', function (Request $request, User $user) {
    $validated = $request->validate([
        'status' => ['required', 'in:pending,approved,rejected']
    ]);

    $user->update(['status' => $validated['status']]);

    return redirect()->back()->with('success', 'User status updated successfully!');
})->middleware('auth')->name('user.updateStatus');

Route::delete('/user/{user}', function (User $user) {
    $user->delete();
    return redirect()->back()->with('success', 'User deleted successfully!');
})->middleware('auth')->name('user.destroy');

Route::put('/clearance/{clearance}/status', [ClearanceController::class, 'updateStatus'])->name('clearance.updateStatus');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/service.php';
require __DIR__ . '/dashboard.php';
