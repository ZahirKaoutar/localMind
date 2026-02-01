<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $questions = $user->questions()->latest()->get();

        return view('profile.show', compact('user', 'questions'));
    }
}
