<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use App\QuestionnaireAnswer;
use App\QuestionnaireQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionnaireController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function show_question_form()
    {
        $questionnaire = Questionnaire::where('is_active', '=', 1)->first();
        $questions = QuestionnaireQuestion::where('questionnaire_id', '=', $questionnaire->id)->get();
        return view('questionnaires.questionnaire_index', compact('questionnaire', 'questions'));
    }

    public function show_result()
    {
        $questionnaire = Questionnaire::where('is_active', '=', 1)->first();
        $questions = QuestionnaireQuestion::where('questionnaire_id', '=', $questionnaire->id)->get();
        $results = array();
        foreach ($questions as $question) {
            $summary = array();
            $answer = DB::table('questionnaire_answers')
                ->join('questionnaire_questions', 'questionnaire_answers.question_id', '=', 'questionnaire_questions.id')
                ->select(DB::raw('questionnaire_questions.seq_num as seq_num, questionnaire_questions.is_description as is_decription, count(questionnaire_answers.user_id) as total_user, sum(questionnaire_answers.rating) as total_rating, (sum(questionnaire_answers.rating))/(count(questionnaire_answers.user_id)) as result'))
                ->where('questionnaire_answers.question_id', '=', $question->id)
                ->groupBy('questionnaire_answers.question_id')
                ->orderBy('questionnaire_questions.seq_num')
                ->first();
            $summary['seq_num'] = $question->seq_num;
            $summary['is_description'] = $question->is_description;
            $summary['question'] = $question->question;
            $summary['total_answer']  = $answer->total_user;
            $summary['total_rating'] = $answer->total_rating;
            $summary['average']   = ceil($answer->result);
            array_push($results, $summary);
        }
//        return $results;
        return view('questionnaires.questionnaire_result', compact('results'));
    }
}
