<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\UserTypesEnum;
use Auth;

class CheckRole
{
    
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();
        
        if ($user && $user->role == $role) {
            return $next($request);
        }
        return redirect()->route('home')->with('error', 'Unauthorized.');
    }
}
