<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        try{
            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);
    
            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);
    
            return redirect()->route('jobSeeker.dash')->with('success', 'تم تحديث كلمة المرور بنجاح');

            }catch(Exception $e)
            {
                Log::info($e);
                return back()->with('error', 'راجع البيانات');
            }
    }
}
