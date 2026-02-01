<?php

namespace App\Repositories;

use App\Models\Question;

  class QuestionRepository {

    public function all(){
        return Question::with('user')->latest()->get();
    }

   public function find($id){
    return Question::findOrFail($id);
}

   


    public function create($data){
        return Question::create($data);
    }
public function update($question, $data){
    return $question->update($data);
}


    public function delete($id){
        return Question::destroy($id);
    }
}
