<?php

namespace App\Http\Middleware;

use App\Models\Subject;
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
				'message' => 'Utente non abilitato. Conferma il tuo account.'
			]);
		}
		
		if(!\Auth::user()->getSubject() instanceof Subject) {
			\Auth::logout();
			return redirect('/login')->withInput([
				'message' => 'Soggetto non valido.'
			]);
		}

		return $next($request);
	}
}
