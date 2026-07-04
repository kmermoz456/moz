<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuizRequest;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        $quiz = Quiz::withCount('questions')->latest()->paginate(15);

        return view('admin.quiz.index', compact('quiz'));
    }

    public function create()
    {
        return view('admin.quiz.create');
    }

    public function store(QuizRequest $request)
    {
        $quiz = Quiz::create($request->only('titre', 'niveau', 'matiere'));

        foreach ($request->input('questions') as $question) {
            $quiz->questions()->create([
                'question'      => $question['question'],
                'choix'         => array_values($question['choix']),
                'bonne_reponse' => $question['bonne_reponse'],
            ]);
        }

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz créé avec succès.');
    }

    public function edit(Quiz $quiz)
    {
        $quiz->load('questions');

        return view('admin.quiz.edit', compact('quiz'));
    }

    public function update(QuizRequest $request, Quiz $quiz)
    {
        $quiz->update($request->only('titre', 'niveau', 'matiere'));

        $quiz->questions()->delete();
        foreach ($request->input('questions') as $question) {
            $quiz->questions()->create([
                'question'      => $question['question'],
                'choix'         => array_values($question['choix']),
                'bonne_reponse' => $question['bonne_reponse'],
            ]);
        }

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz mis à jour.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz supprimé.');
    }
}
