<?php

namespace App\Http\Controllers;

use App\Interfaces\SubjectRepositoryInterface;
use App\Models\GroupModule;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller implements HasMiddleware
{

    protected $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public static function middleware(): array
    {
        return [
            // read
            new Middleware('permission:sessions-subject.view', only: ['index', 'show']),

            // create
            new Middleware('permission:sessions-subject.create', only: ['create', 'store']),

            // update
            new Middleware('permission:sessions-subject.edit', only: ['edit', 'update']),

            // delete
            new Middleware('permission:sessions-subject.delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->subjectRepository->all();

        // dd($data);

        $allColumns = ['name', 'code', 'groups', 'is_optional', 'created_by', 'created_at', 'is_active',];
        $visibleColumns = ['name', 'code', 'is_optional', 'groups', 'created_by', 'is_active'];
        return view('dashboard.pages.subjects.index', compact('data', 'allColumns', 'visibleColumns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groupData = GroupModule::where('is_active', 1)->get();

        return view("dashboard.pages.subjects.create", compact('groupData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'code'        => 'required|integer|unique:subjects,code',
            'is_optional' => 'nullable|boolean',
            'group_ids'   => 'required|array',
            'group_ids.*' => 'exists:group_modules,id',
        ]);
        try {
            DB::transaction(function () use ($validated) {
                // Step 1: Insert subject
                $subject = $this->subjectRepository->create([
                    'name'        => $validated['name'],
                    'code'        => $validated['code'],
                    'is_optional' => $validated['is_optional'] ?? false,
                    'user_id'     => auth()->id(), // if required
                ]);

                // Step 2: Insert pivot table entries manually
                $pivotData = [];
                foreach ($validated['group_ids'] as $groupId) {
                    $pivotData[] = [
                        'subject_id' => $subject->id,
                        'group_id'   => $groupId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                DB::table('group_subject')->insert($pivotData);
            });

            return redirect()->route('subject.index')
                ->with('success', '✅ Subject and group assignments created successfully.');
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
        $subject = Subject::with(['groups'])
            ->findOrFail($id);

        return view("dashboard.pages.subjects.view", compact('subject'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $groupData = GroupModule::where('is_active', 1)->get();
        $subjectData = $this->subjectRepository->find($id);

        return view("dashboard.pages.subjects.edit", compact('groupData', 'subjectData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'code'        => 'required|integer|unique:subjects,code,' . $id,
            'is_optional' => 'nullable|boolean',
            'group_ids'   => 'required|array',
            'group_ids.*' => 'exists:group_modules,id',
        ]);

        try {
            DB::transaction(function () use ($validated, $id) {
                // Step 1: Update subject
                $subject = $this->subjectRepository->find($id);
                $subject->update([
                    'name'        => $validated['name'],
                    'code'        => $validated['code'],
                    'is_optional' => $validated['is_optional'] ?? false,
                    'user_id'     => auth()->id(), // keep track of updater if needed
                ]);

                // Step 2: Sync pivot table
                $pivotData = [];
                foreach ($validated['group_ids'] as $groupId) {
                    $pivotData[$groupId] = [
                        'updated_at' => now(),
                    ];
                }
                // Using Eloquent relationship
                $subject->groups()->sync($pivotData);
            });

            return redirect()->route('subject.index')
                ->with('success', '✅ Subject and group assignments updated successfully.');
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
            DB::transaction(function () use ($id) {
                $subject = $this->subjectRepository->find($id);

                if (!$subject) {
                    throw new \Exception("Subject not found.");
                }

                // Step 1: Delete pivot data
                DB::table('group_subject')->where('subject_id', $subject->id)->delete();

                // Step 2: Delete subject
                $subject->delete();
            });

            return redirect()->route('subject.index')
                ->with('success', '🗑️ Subject deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', '❌ ' . $e->getMessage());
        }
    }
}
