<?php

namespace App\Repositories;

use App\Models\Favoris;

class FavoriteRepository
{
    public function add(int $userId, int $questionId): Favoris
    {
        return Favoris::create([
            'user_id' => $userId,
            'question_id' => $questionId,
        ]);
    }

    public function remove(int $userId, int $questionId): int
    {
        return Favoris::where('user_id', $userId)
                      ->where('question_id', $questionId)
                      ->delete();
    }

    public function exists(int $userId, int $questionId): bool
    {
        return Favoris::where('user_id', $userId)
                      ->where('question_id', $questionId)
                      ->exists();
    }
    public function getUserFavorites($userId)
{
    return Favoris::with('question') // charge les questions liées
                  ->where('user_id', $userId)
                  ->get()
                  ->pluck('question'); // récupère uniquement les questions
}

}
