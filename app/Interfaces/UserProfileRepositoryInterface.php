<?php

namespace App\Interfaces;

interface UserProfileRepositoryInterface
{
    public function all();
    public function find($id);
    public function findUserWithProfile($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
