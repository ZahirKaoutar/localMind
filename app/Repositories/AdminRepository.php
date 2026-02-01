<?php
namespace App\Repositories;
use App\Models\Question;
use App\Models\User;
use App\Models\Response;
 
class AdminRepository {

    public function countUsers(){
        return User::count();
    }

    public function countQuestions(){
        return Question::count();
    }

    public function countResponses(){
        return Response::count();
    }

    public function getUsers(){
        return User::withCount('questions')->get();
    }
}


