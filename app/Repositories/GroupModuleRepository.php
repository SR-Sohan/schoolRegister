<?php

namespace App\Repositories;

use App\Interfaces\GroupModuleRepositoryInterface;
use App\Models\GroupModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GroupModuleRepository implements GroupModuleRepositoryInterface
{
    public function all()
    {
        return GroupModule::with('user')->get();
    }

    public function find($id)
    {
        return GroupModule::findOrFail($id);
    }

    public function create(array $data)
    {
        try {

            $data['user_id'] = Auth::id();
            $data['is_active'] = $data['is_active'] ?? 0;
            $class = GroupModule::create($data);

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
        try {
            $data['is_active'] = $data['is_active'] ?? 0;

            $class = GroupModule::findOrFail($id);

            $class->update($data);

            return $class;
        } catch (\Exception $e) {
            Log::error('Class update failed: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'class_id' => $id,
                'input_data' => $data,
            ]);

            throw new \Exception('Class update failed. Please try again later.');
        }
    }

    public function delete($id)
    {
        return GroupModule::destroy($id);
    }
}
