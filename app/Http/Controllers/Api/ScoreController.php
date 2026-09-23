<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'data' => Result::query()
                ->where('user_id', $request->user()->id)
                ->with('user:id,name')
                ->orderByDesc('date')
                ->orderByDesc('id')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'score' => ['required', 'integer', 'min:0'],
            'correct_answers' => ['required', 'integer', 'min:0'],
            'remaining_lives' => ['required', 'integer', 'min:0'],
            'date' => ['sometimes', 'date'],
        ]);

        $result = Result::create([
            'user_id' => $request->user()->id,
            'score' => $validated['score'],
            'correct_answers' => $validated['correct_answers'],
            'remaining_lives' => $validated['remaining_lives'],
            'date' => $validated['date'] ?? now()->toDateString(),
        ]);

        return response()->json([
            'data' => $result,
        ], 201);
    }

    public function show(Request $request, Result $score)
    {
        abort_unless($score->user_id === $request->user()->id, 403);

        return response()->json([
            'data' => $score->load('user:id,name'),
        ]);
    }
}
