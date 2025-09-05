<?php

namespace App\Repositories;

use App\Interfaces\SubjectRepositoryInterface;
use App\Models\Subject;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function all()
    {
        return Subject::with('groups')->get();
    }

    public function find($id)
    {
        return Subject::findOrFail($id);
    }

    public function create(array $data)
    {
        return Subject::create($data);
    }

    public function update($id, array $data)
    {
        $model = Subject::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        return Subject::destroy($id);
    }
}
