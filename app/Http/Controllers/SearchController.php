<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function getResult(Request $request)
	{
		$query = $request->input('query');

		if (!$query) {
			redirect()->back();
		}

		$users = User::where(DB::raw("CONCAT (name, ' ', surname)"), 'LIKE', "%{$query}%")
            ->orWhere('surname', 'LIKE', "%{$query}%")
            ->get();
		
		return view('search.results')->with('users', $users);
	}

}
