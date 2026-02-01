<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class FavoriteController extends Controller
{
    public function __construct(private FavoriteService $service) {}

    public function toggle(int $questionId): RedirectResponse
    {
        $this->service->toggle(Auth::id(), $questionId);

        return back();
    }
    public function index()
{
    $questions = $this->service->getFavoritesForAuthUser();

    return view('favorites.index', compact('questions'));
}

}
