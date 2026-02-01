<?php
namespace App\Services;
use App\Repositories\AdminRepository;



class AdminService {

    public function __construct(private AdminRepository $repo){}

    public function getStats(){
        return [
            'users' => $this->repo->countUsers(),
            'questions' => $this->repo->countQuestions(),
            'responses' => $this->repo->countResponses(),
        ];
    }

    public function getUsers(){
        return $this->repo->getUsers();
    }
}