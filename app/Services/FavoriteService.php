<?php

namespace App\Services;

use App\Repositories\FavoriteRepository;
use Illuminate\Support\Facades\Auth;

class FavoriteService
{
    public function __construct(private FavoriteRepository $repo) {}

    public function toggle(int $userId, int $questionId): void
    {
        if ($this->repo->exists($userId, $questionId)) {
            $this->repo->remove($userId, $questionId);
        } else {
            $this->repo->add($userId, $questionId);
        }
    }

    // Optionnel : méthode pour ajouter directement
    public function add(int $userId, int $questionId)
    {
        return $this->repo->add($userId, $questionId);
    }
    public function getFavoritesForAuthUser()
{
    return $this->repo->getUserFavorites(Auth::id());
}

}
