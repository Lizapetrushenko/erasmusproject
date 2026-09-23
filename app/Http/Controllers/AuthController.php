<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            $errors = ['email' => 'The email or password is incorrect.'];

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $errors['email'],
                    'errors' => ['email' => [$errors['email']]],
                ], 422);
            }

            return back()->withInput($request->only('email'))->withErrors($errors);
        }

        $request->session()->regenerate();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Login successful.',
                'redirect' => route('dashboard'),
            ]);
        }

        return redirect()->intended(route('dashboard'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Registration successful. Please sign in.',
                'redirect' => route('login'),
            ], 201);
        }

        return redirect()->route('login')->with('status', 'Registration successful. Please sign in.');
    }

    public function forgotPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user) {
            $message = 'No account was found with this email address.';

            if (! $request->expectsJson()) {
                return back()->withInput()->withErrors(['email' => $message]);
            }

            return response()->json([
                'message' => $message,
                'errors' => ['email' => [$message]],
            ], 422);
        }

        $user->forceFill([
            'password' => Hash::make($validated['password']),
        ])->save();

        if (! $request->expectsJson()) {
            return redirect()->route('login')->with('status', 'Password successfully reset. Please sign in.');
        }

        return response()->json([
            'message' => 'Password successfully reset. Please sign in.',
            'redirect' => route('login'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRule::min(8)
            ],
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            if (! $request->expectsJson()) {
                return back()->withInput()->withErrors(['email' => __($status)]);
            }

            return response()->json([
                'message' => __($status),
            ], 422);
        }

        if (! $request->expectsJson()) {
            return redirect()->route('login')->with('status', 'Password successfully reset. Please sign in.');
        }

        return response()->json([
            'message' => 'Password successfully reset.',
            'redirect' => route('login'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json(['redirect' => route('login')]);
        }

        return redirect()->route('login');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$request->user()->id],
            'current_password' => ['nullable', 'current_password'],
            'password' => ['nullable', 'confirmed', PasswordRule::min(8)],
        ]);

        if (! empty($validated['password']) && empty($validated['current_password'])) {
            return back()->withErrors(['current_password' => 'Enter your current password to change it.']);
        }

        $user = $request->user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        return back()->with('status', 'Profile updated successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'Your account was deleted.');
    }
}