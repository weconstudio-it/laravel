<?php

namespace App\Http\Middleware;

use Closure;

class Enable
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(!\Auth::user()->getEnabled()) {
			// effettuo il logout
			\Auth::logout();
			return redirect('/login')->withInput([
				'message' => 'User not enabled. Please confirm your account.'
			]);
		}

		return $next($request);
	}
}
