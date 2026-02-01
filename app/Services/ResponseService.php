<?php

namespace App\Services;

use App\Repositories\ResponseRepository;
use Illuminate\Support\Facades\Auth;

class ResponseService
{
    public function __construct(private ResponseRepository $repo) { }

    public function create(array $data, int $questionId)
    {
        $data['question_id'] = $questionId;
        $data['user_id'] = Auth::id();

        return $this->repo->create($data);
    }

    public function update(int $id, array $data)
    {
        $response = $this->repo->find($id);

        // ✅ Admin peut modifier toutes les réponses
        if (Auth::user()->role !== 'admin' && $response->user_id !== Auth::id()) {
            abort(403, 'Accès interdit');
        }

        return $this->repo->update($response, $data);
    }

    public function delete(int $id)
    {
        $response = $this->repo->find($id);

        // ✅ Admin peut supprimer toutes les réponses
        if (Auth::user()->role !== 'admin' && $response->user_id !== Auth::id()) {
            abort(403, 'Accès interdit');
        }

        return $this->repo->delete($id);
    }

public function getOne($id)
{
    return $this->repo->find($id);
}
}