<?php

namespace App\Services;

use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Auth;

class QuestionService {

    public function __construct(
        private QuestionRepository $repo
    ){ }

    public function getAll(){
        return $this->repo->all();
    }

    public function getOne($id){
        return $this->repo->find($id);
    }

    public function create($data){
        $data['user_id'] = Auth::id();
        return $this->repo->create($data);
    }

    public function update($id, $data){
        $question = $this->repo->find($id);

        // ✅ Admin peut modifier toutes les questions
        if (Auth::user()->role !== 'admin' && $question->user_id !== Auth::id()) {
            abort(403, 'Accès interdit');
        }

        return $this->repo->update($question, $data);
    }

    public function delete($id){
        $question = $this->repo->find($id);

        // ✅ Admin peut supprimer toutes les questions
        if (Auth::user()->role !== 'admin' && $question->user_id !== Auth::id()) {
            abort(403, 'Accès interdit');
        }

        return $this->repo->delete($id);
    }
}
