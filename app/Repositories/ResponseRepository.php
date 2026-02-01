<?php

namespace App\Repositories;

use App\Models\Response;

class ResponseRepository {

    public function create(array $data): Response
    {
        return Response::create($data);
    }

    public function find(int $id): Response
    {
        return Response::findOrFail($id);
    }

    public function update(Response $response, array $data): bool
    {
        return $response->update($data);
    }

    public function delete(int $id): int
    {
        return Response::destroy($id);
    }

    public function getAll()
    {
        return Response::with('user', 'question')->latest()->get();
    }
}
