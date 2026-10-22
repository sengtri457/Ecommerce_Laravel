<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'phone' => 'nullable|string|max:20',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'role' => 'customer',
        'password' => Hash::make($validated['password']),
    ]);

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'message' => 'User registered successfully',
        'token' => $token,
        'user' => $user,
    ], 201);
});

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'message' => 'Logged in successfully',
        'token' => $token,
        'user' => $user,
    ]);
});

// Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    });
});
