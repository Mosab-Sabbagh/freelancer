<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\UserRole;

class RedirectIfAuthenticatedByRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->user_type) {
                case UserRole::ADMIN:
                    return redirect()->route('admin.dashboard');
                case UserRole::JOB_SEEKER:
                    return redirect()->route('jobSeeker.dash');
                case UserRole::JOB_POSTER:
                    return redirect()->route('jobPoster.dash');
                case UserRole::SUPPORTER:
                    return redirect()->route('supporter.dash');
                default:
                    return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
