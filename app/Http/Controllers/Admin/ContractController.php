<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Freelance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractController extends Controller
{
    // user authorized
    public function application()
    {
        $applications = auth()->user()
            ->freelances()
            ->with(['admin'])
            ->latest('freelance_user.created_at')
            ->get();

        return view('user.application.index', compact('applications'));
    }

    public function show(Freelance $freelance)
    {
        $user = auth()->user();

        // Get the application from the pivot (many-to-many) relationship
        $application = $user->freelances()
            ->with(['category', 'admin'])
            ->where('freelance_id', $freelance->id)
            ->first();

        if (!$application) {
            abort(404); // If the user has not applied
        }

        return view('user.application.show', compact('freelance', 'application'));
    }

    public function apply(Freelance $freelance)
    {
        // Check if the user has already applied
        if (auth()->user()->freelances()->where('freelance_id', $freelance->id)->exists()) {
            return redirect()->route('application')->with('error', 'You have already applied for this freelance.');
        }

        auth()->user()->freelances()->attach($freelance->id);

        return redirect()->route('application')->with('success', 'Application submitted successfully.');
    }

    public function withdraw(Freelance $freelance)
    {
        auth()->user()->freelances()->detach($freelance->id);
        return redirect()->route('application')->with('success', 'Application withdrawn successfully.');
    }

    // admin authorized
    public function updateStatus(Request $request, Freelance $freelance, User $user)
    {
        // Verify ownership
        if ($freelance->admin_id !== auth()->guard('admin')->id()) {
            abort(403);
        }

        $status = $request->input('status');

        $data = [
            'status' => $status,
            'start_date' => null,
            'end_date' => null,
            'final_salary' => null,
        ];

        if ($status === 'accepted') {
            $validated = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'final_salary' => 'required|numeric|min:0',
            ]);

            $data = array_merge($data, $validated);
        }

        $freelance->applicants()->updateExistingPivot($user->id, $data);

        return redirect()->back()->with('success', 'Application status updated.');
    }
}
