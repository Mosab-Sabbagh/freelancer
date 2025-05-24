<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\JobSeeker;
use App\Models\Company;
use App\Models\JobPoster;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\UserRole;
use Illuminate\Support\Facades\Log;

use function Illuminate\Log\log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('guest.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'user_type' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

            // إذا كان jobposter نطلب تحديد النوع (فرد/شركة)
        if ($request->user_type == UserRole::JOB_SEEKER) {
            $rules['poster_type'] = ['required', 'in:individual,company'];
        }

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'password' => Hash::make($request->password),
        ]);



        switch ($request->user_type) {
            case UserRole::JOB_POSTER:
                $jobPoster = JobPoster::create([
                    'user_id' => $user->id,
                    'poster_type' => $request->poster_type,
                ]);
                break;
            case UserRole::JOB_SEEKER:
                $jobSeeker = JobSeeker::create([
                    'user_id' => $user->id,
                ]);
                break;
        }

        if($request->user_type == UserRole::JOB_POSTER & $request->poster_type =='company'){
            $campany = Company::create([
                'job_poster_id' => $jobPoster->id,
            ]);
        }
        
        event(new Registered($user));

        Auth::login($user);
        
        switch ($user->user_type) {
        case UserRole::ADMIN:
            return redirect()->route('admin.dash');
        case UserRole::JOB_SEEKER:
            return redirect()->route('jobSeeker.dash');
        case UserRole::JOB_POSTER:
            return redirect()->route('jobPoster.dash');
        case UserRole::SUPPORTER:
            return redirect()->route('supporter.dash');
        default:
            return redirect()->route('home');
    }
    

        // return redirect(route('dashboard', absolute: false));
    }
}
