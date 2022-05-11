<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $formData = $request->all();
        if (($formData['name'] !== '' || $formData['name'] != null) && ($formData['email'] !== '' || $formData['email'] != null)
            && ($formData['mobile'] !== '' || $formData['mobile'] != null) && ($formData['address'] !== '' || $formData['address'] != null)
            && ($formData['username'] !== '' || $formData['username'] != null) && ($formData['password'] !== '' || $formData['password'] != null)
        ) {
            return $next($request);
        } else {
            return false;
        }        
    }
}
