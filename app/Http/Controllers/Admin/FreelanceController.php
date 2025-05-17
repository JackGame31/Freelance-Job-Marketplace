<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Freelance;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFreelanceRequest;
use App\Http\Requests\UpdateFreelanceRequest;

class FreelanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $freelances = Freelance::with(['admin', 'category'])
            ->withCount('applicants')
            ->where('admin_id', auth()->guard('admin')->id())
            ->latest()
            ->paginate(10);

        return view('admin.freelance.index', compact('freelances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.freelance.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFreelanceRequest $request)
    {
        $validated = $request->validated();

        $validated['admin_id'] = auth()->guard('admin')->id();

        Freelance::create($validated);

        return redirect()->route('admin.freelances.index')->with('success', 'Freelance job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Freelance $freelance)
    {
        $this->authorizeAccess($freelance);
        $applicants = $freelance->applicants()->orderBy('created_at', 'desc')->get();

        return view('admin.freelance.show', compact('freelance', 'applicants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Freelance $freelance)
    {
        $this->authorizeAccess($freelance);

        $categories = Category::orderBy('name')->get();
        return view('admin.freelance.form', compact('freelance', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFreelanceRequest $request, Freelance $freelance)
    {
        $this->authorizeAccess($freelance);

        $validated = $request->validated();

        $freelance->update($validated);

        return redirect()->route('admin.freelances.index')->with('success', 'Freelance job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Freelance $freelance)
    {
        $this->authorizeAccess($freelance);

        $freelance->delete();

        return redirect()->route('admin.freelances.index')->with('success', 'Freelance job deleted successfully.');
    }

    /**
     * Authorize that the admin owns the freelance item.
     */
    protected function authorizeAccess(Freelance $freelance)
    {
        if ($freelance->admin_id !== auth()->guard('admin')->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
