<?php

namespace App\Http\Middleware;

use Closure;

class Ajax
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
		if($request->path() != '/') {
			if(!$request->ajax()) {
				$query = "";
				if($request->getQueryString() != "") $query = "?" . $request->getQueryString();
				return redirect('/#' . $request->path() . $query);
			}
		}

		return $next($request);
	}
}