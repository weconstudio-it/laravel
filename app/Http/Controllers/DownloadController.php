<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DownloadController extends Controller
{
	
	public function download(Request $request) {
		return response()->download(storage_path() . $request->input('file', ''));
	}
	
}
