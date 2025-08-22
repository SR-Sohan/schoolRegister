<?php

namespace App\Repositories;

use App\Interfaces\UserProfileRepositoryInterface;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    public function all()
    {
        return User::with('profile')->get();
    }

    public function find($id)
    {
        return UserProfile::findOrFail($id);
    }

    public function findUserWithProfile($id)
    {
        return User::with('profile')->findOrFail($id);
    }

    public function create(array $data): User
    {
        DB::beginTransaction();

        try {
            // 1️⃣ Create user
            $user = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'mobile'    => $data['phone'],
                'password'  => Hash::make($data['password']),
                'is_active' => $data['is_active'] ?? 0,
            ]);

            // 2️⃣ Create user profile if school
            if (!empty($data['is_school'])) {
                $photoPath = null;
                if (isset($data['school_photo'])) {
                    $photoPath = $data['school_photo']->store('schools', 'public');
                }

                UserProfile::create([
                    'user_id'     => $user->id,
                    'school_name' => $data['school_name'] ?? null,
                    'address'     => $data['school_address'] ?? null,
                    'photo'       => $photoPath,
                ]);
            }

            // 3️⃣ Assign role (Spatie)
            if (!empty($data['role'])) {
                $roleName = $data['role'];


                $user->syncRoles($roleName);
            }

            // 4️⃣ Commit transaction
            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack(); // ❌ Rollback on any error
            Log::error('User creation failed: ' . $e->getMessage());
            throw new \Exception('User creation failed: ' . $e->getMessage());
        }
    }



    public function update($id, array $data)
    {
        DB::beginTransaction();

        try {
            $user = User::with('profile')->findOrFail($id);

            // 1️⃣ Update user
            $user->name      = $data['name'];
            $user->email     = $data['email'];
            $user->mobile    = $data['phone'];
            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }
            $user->is_active = $data['is_active'] ?? 0;
            $user->save();

            // 2️⃣ Update profile if school
            if (!empty($data['is_school'])) {

                $user->profile->school_name = $data['school_name'] ?? $user->profile->school_name;
                $user->profile->address     = $data['school_address'] ?? $user->profile->address;
                $user->profile->save();
            }

            // 3️⃣ Update role
            if (!empty($data['role'])) {
                if (!$user->hasRole($data['role'])) {
                    $user->syncRoles([$data['role']]);
                }
            }

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User update failed: ' . $e->getMessage());
            throw new \Exception('User update failed: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $user = User::find($id);

            if (!$user) {
                throw new \Exception('User not found.');
            }
            $user->delete();

            return true;
        });
    }
}
