<?php

namespace App\Http\Controllers;

use App\Interfaces\UserProfileRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;

class UserProfileController extends Controller implements HasMiddleware
{

    protected $userProfileRepository;

    public function __construct(UserProfileRepositoryInterface $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

   public static function middleware(): array
    {
        return [
            // read
            new Middleware('permission:users-user.view', only: ['index','show']),

            // create
            new Middleware('permission:users-user.create', only: ['create','store']),

            // update
            new Middleware('permission:users-user.edit', only: ['edit','update']),

            // delete
            new Middleware('permission:users-user.delete', only: ['destroy']),
        ];
    }
    public function index()
    {
        $data = $this->userProfileRepository->all();
        $allColumns = ['name', 'school_name', 'role_names','address', 'email', 'mobile', 'is_active',];
        $visibleColumns = ['name', 'school_name','role_names', 'email', 'is_active'];
        return view('dashboard.pages.user.index', compact('data', 'allColumns', 'visibleColumns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('dashboard.pages.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required',
            'password'      => 'required|min:6|confirmed',
            'role'          => 'required|string',
            'is_active'     => 'nullable|boolean',
            'is_school'     => 'nullable|boolean',
            'school_name'   => 'nullable|string|max:255',
            'school_address' => 'nullable|string|max:255',
            'school_photo'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $user = $this->userProfileRepository->create($validated);

            return redirect()->route('userprofile.index')
                ->with('success', '✅ User created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', '❌ ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = $this->userProfileRepository->findUserWithProfile($id); // eager load profile and roles

        return view('dashboard.pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->userProfileRepository->findUserWithProfile($id);

        $roles = Role::pluck('name', 'id');

        return view('dashboard.pages.user.edit', compact('data', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => "required|email|unique:users,email,{$id}",
            'phone'         => 'required',
            'password'      => 'nullable|min:6',
            'role'          => 'required|string',
            'is_active'     => 'nullable|boolean',
            'is_school'     => 'nullable|boolean',
            'school_name'   => 'nullable|string|max:255',
            'school_address' => 'nullable|string|max:255',
            'school_photo'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $this->userProfileRepository->update($id, $validated);

            return redirect()->route('userprofile.index')
                ->with('success', '✅ User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', '❌ ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->userProfileRepository->delete($id);

            return redirect()->route('userprofile.index')
                ->with('success', 'User and profile deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('userprofile.index')
                ->with('error', 'Failed to delete user. Error: ' . $e->getMessage());
        }
    }
}
