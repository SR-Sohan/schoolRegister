<?php

namespace App\Repositories;

use App\Interfaces\ClassModuleRepositoryInterface;
use App\Models\ClassModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClassModuleRepository implements ClassModuleRepositoryInterface
{
    public function all()
    {
        return ClassModule::with('user')->get();
    }

    public function find($id)
    {
        return ClassModule::findOrFail($id);
    }

    public function create(array $data)
    {
        try {

            $data['user_id'] = Auth::id();
            $data['is_active'] = $data['is_active'] ?? 0;
            $class = ClassModule::create($data);

            return $class;
        } catch (\Exception $e) {
            Log::error('Class creation failed: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'input_data' => $data,
            ]);

            throw new \Exception('Class creation failed. Please try again later.');
        }
    }

    public function update($id, array $data)
    {
        $model = ClassModule::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        return ClassModule::destroy($id);
    }
}
