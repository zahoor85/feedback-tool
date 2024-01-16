<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Filters\UsersFilter;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {

        $users = User::all();
        return new UserCollection($users);
    }

    public function search(Request $request)
    {
    
        $searchTerm = $request->input('search');
        // Perform the search query
        $users = User::where('name', 'like', "%{$searchTerm}%")
            ->orWhere('email', 'like', "%{$searchTerm}%")
            ->get();
        // Return the results
        return new UserCollection($users);
    }
}
