<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quiz = Quiz::where('niveau', auth()->user()->niveau)
            ->withCount('questions')
            ->orderBy('matiere')
            ->get()
            ->groupBy('matiere');

        $historique = auth()->user()->quizAttempts()->with('quiz')->latest()->take(10)->get();

        return view('etudiant.quiz.index', compact('quiz', 'historique'));
    }

    public function show(Quiz $quiz)
    {
        abort_unless($quiz->niveau === auth()->user()->niveau, 403);

        $quiz->load('questions');

        return view('etudiant.quiz.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        abort_unless($quiz->niveau === auth()->user()->niveau, 403);

        $reponses = $request->input('reponses', []);
        $questions = $quiz->questions;

        $score = 0;
        foreach ($questions as $question) {
            if ($question->estCorrecte($reponses[$question->id] ?? null)) {
                $score++;
            }
        }

        $attempt = QuizAttempt::create([
            'user_id'  => auth()->id(),
            'quiz_id'  => $quiz->id,
            'score'    => $score,
            'total'    => $questions->count(),
            'reponses' => $reponses,
        ]);

        return redirect()->route('etudiant.quiz.resultats', $attempt);
    }

    /**
     * Correction détaillée d'une tentative : score, réponses de l'étudiant et explications.
     */
    public function resultats(QuizAttempt $attempt)
    {
        abort_unless($attempt->user_id === auth()->id(), 403);

        $attempt->load('quiz.questions');

        return view('etudiant.quiz.resultats', compact('attempt'));
    }
}
