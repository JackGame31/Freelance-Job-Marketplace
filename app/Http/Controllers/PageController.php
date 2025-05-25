<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Freelance;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $categories = Category::orderBy('name')->get();
        return view('home', compact('categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category_id');

        $freelances = Freelance::with(['admin', 'category'])
            ->where('status', 'open')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->orWhereHas('admin', function ($adminQuery) use ($query) {
                            $adminQuery->where('name', 'like', "%{$query}%");
                        });
                });
            })
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('search', compact('freelances', 'categories'));
    }

    public function show(Freelance $freelance)
    {
        $user = auth()->user();
        if ($user && $freelance->applicants()->where('user_id', $user->id)->exists()) {
            return redirect()->route('application.show', $freelance->id);
        }

        return view('freelance', [
            'freelance' => $freelance->load(['admin', 'category']),
        ]);
    }

    public function about()
    {
        return view('about');
    }
}
