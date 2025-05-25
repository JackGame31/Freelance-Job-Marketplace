<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Payment;
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

    public function showUser(Freelance $freelance)
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

        // get payment history
        $applicant = $freelance->applicants()->where('user_id', auth()->id())->first();
        $payments = $applicant ? Payment::where('contract_id', $applicant->pivot->id)->latest()->paginate(5) : collect();
        $totalPayment = $applicant ? Payment::where('contract_id', $applicant->pivot->id)->sum('amount') : 0;

        return view('user.application.show', compact('freelance', 'application', 'payments', 'totalPayment'));
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
    public function showAdmin(Freelance $freelance, User $user)
    {
        // Verify ownership
        abort_if($freelance->admin_id !== auth()->guard('admin')->id(), 403);

        $applicant = $freelance->applicants()->where('user_id', $user->id)->firstOrFail();

        $payments = Payment::where('contract_id', $applicant->pivot->id)->latest()->paginate(5);
        $totalPayment = Payment::where('contract_id', $applicant->pivot->id)->sum('amount');

        return view('admin.freelance.applicant', compact('freelance', 'applicant', 'payments', 'totalPayment'));
    }

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

    public function pay(Request $request, Freelance $freelance, User $user)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:1',
            'notes' => 'nullable|string|max:255',
        ]);

        $contract_id = $freelance->applicants()
            ->where('user_id', $user->id)
            ->first()
            ->pivot
            ->id;
        
        Payment::create([
            'contract_id' => $contract_id,
            'amount' => $data['amount'],
            'notes' => $data['notes'],
        ]);

        return redirect()->back()->with('success', 'Payment recorded successfully.');
    }
}
