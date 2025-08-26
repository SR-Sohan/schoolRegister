<?php

namespace App\Http\Controllers;

use App\Interfaces\GroupModuleRepositoryInterface;
use App\Models\ClassModule;
use App\Models\GroupModule;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GroupModuleController extends Controller  implements HasMiddleware
{

    protected $groupModuleRepository;

    public function __construct(GroupModuleRepositoryInterface $groupModuleRepository)
    {
        $this->groupModuleRepository = $groupModuleRepository;
    }

    public static function middleware(): array
    {
        return [
            // read
            new Middleware('permission:sessions-group.view', only: ['index', 'show']),

            // create
            new Middleware('permission:sessions-group.create', only: ['create', 'store']),

            // update
            new Middleware('permission:sessions-group.edit', only: ['edit', 'update']),

            // delete
            new Middleware('permission:sessions-group.delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->groupModuleRepository->all();

        $allColumns = ['name', 'class_name', 'created_by', 'created_at', 'is_active',];
        $visibleColumns = ['name', 'class_name', 'created_by', 'created_at', 'is_active'];
        return view('dashboard.pages.group.index', compact('data', 'allColumns', 'visibleColumns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classData = ClassModule::where('is_active', 1)->get();

        return view("dashboard.pages.group.create", compact('classData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'is_active'     => 'nullable|boolean',
            'class_id' =>   'required'
        ]);

        try {
            $user = $this->groupModuleRepository->create($validated);

            return redirect()->route('groupmodule.index')
                ->with('success', '✅ Group created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', '❌ ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupModule $groupModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $classModule = $this->groupModuleRepository->find($id); // eager load profile and roles
        $classData = ClassModule::where('is_active', 1)->get();

        return view('dashboard.pages.group.edit', compact('classModule', 'classData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'is_active'     => 'nullable|boolean',
            'class_id' => 'required'
        ]);

        try {
            $this->groupModuleRepository->update($id, $validated);

            return redirect()->route('groupmodule.index')
                ->with('success', '✅ Group updated successfully.');
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
            $this->groupModuleRepository->delete($id);

            return redirect()->route('groupmodule.index')
                ->with('success', 'Group  deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('groupmodule.index')
                ->with('error', 'Failed to delete class. Error: ' . $e->getMessage());
        }
    }
}
