<?php

namespace App\Http\Controllers;

use App\Interfaces\ClassModuleRepositoryInterface;
use App\Models\ClassModule;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ClassModuleController extends Controller implements HasMiddleware
{
    protected $classModuleRepository;

    public function __construct(ClassModuleRepositoryInterface $classModuleRepository)
    {
        $this->classModuleRepository = $classModuleRepository;
    }

    public static function middleware(): array
    {
        return [
            // read
            new Middleware('permission:sessions-class.view', only: ['index', 'show']),

            // create
            new Middleware('permission:sessions-class.create', only: ['create', 'store']),

            // update
            new Middleware('permission:sessions-class.edit', only: ['edit', 'update']),

            // delete
            new Middleware('permission:sessions-class.delete', only: ['destroy']),
        ];
    }
    public function index()
    {
        $data = $this->classModuleRepository->all();

        $allColumns = ['name', 'created_by', 'created_at', 'is_active',];
        $visibleColumns = ['name', 'created_by', 'created_at', 'is_active'];
        return view('dashboard.pages.class.index', compact('data', 'allColumns', 'visibleColumns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.pages.class.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'is_active'     => 'nullable|boolean'
        ]);

        try {
            $user = $this->classModuleRepository->create($validated);

            return redirect()->route('classmodule.index')
                ->with('success', '✅ Class created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', '❌ ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassModule $classModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassModule $classModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassModule $classModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassModule $classModule)
    {
        //
    }
}
