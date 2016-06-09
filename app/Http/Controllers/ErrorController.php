<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use Propel\PropelLaravel\Auth\PropelUserProvider;
use SAF\Models\User;

class ErrorController extends Controller
{
	public function index() {
		return view('errors.generic');
    }
}
