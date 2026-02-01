<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserService
{
    protected  UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->userRepository->createUser($data);
    }

    public function findUser($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function showAll()
    {
        return $this->userRepository->getAllUsers();
    }

    public function updateUser($id, array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->userRepository->updateUser($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
