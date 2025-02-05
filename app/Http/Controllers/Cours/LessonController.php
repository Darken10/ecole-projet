<?php

namespace App\Http\Controllers\Cours;

use Exception;
use App\Models\User;
use App\Models\Matiere;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\TypeQuestion;
use App\Models\Cours\Exercice;
use App\Models\Cours\Question;
use App\Models\Cours\Soumition;
use App\Models\Cours\Evaluation;
use App\Models\Cours\Partie\Lesson;
use App\Http\Controllers\Controller;
use App\Models\Cours\Partie\Content;
use Illuminate\Support\Facades\Hash;
use App\Models\Cours\Partie\UserQuestion;

class LessonController extends Controller
{

    function index()
    {
        $matieres = Lesson::all_my_niveau_matieres();

        $lessons_order = Lesson::all()->filter(fn ($lesson)=> $lesson->chapitre?->niveau_id==auth()->user()->niveau_id)->filter(fn ($lesson)=>count($lesson->users()->wherePivot('apreciation','>',0)->withPivot('apreciation')->get())>0);
        return view('cours.client.lesson.index', [
            'matieres' => $matieres,
            'lessons_order' => $lessons_order
        ]);
    }

    function show(Lesson $lesson)
    {
        $lesson->addView();
        if(auth()->user()->payment->exists() and auth()->user()->payment->statut=="completed" ){
            if ($lesson->users()->where('user_id', auth()->user()->id)->exists()) {
                return to_route('cours.suivre', [
                    'lesson' => $lesson
                ]);
            }
            return view('cours.client.lesson.show', [
                'lesson' => $lesson
            ]);
        }
        else{
            return view('payment.index');
        }
    }

    function suivre(Lesson $lesson)
    {
        $lesson->addFollower();
        $content = $lesson->contents->first();
        $numero = 1;
        return view('cours.client.lesson.lesson', [
            'numero' => $numero,
            'prev_content' =>  null,
            'lesson' => $lesson,
            'content' => $content,
            'next_content' => $lesson->contents[1] ?? null,

        ]);
    }

    function sectionSuivante(Lesson $lesson, Content $content, int $numero)
    {
        $numero = $numero + 1;
        return view('cours.client.lesson.lesson', [
            'numero' => $numero,
            'prev_content' =>  $lesson->contents[$numero - 1] ?? null,
            'lesson' => $lesson,
            'content' => $content,
            'next_content' => $lesson->contents[$numero] ?? null
        ]);
    }

    function sectionArriere(Lesson $lesson, Content $content, int $numero)
    {
        $numero = $numero + 1;
        return view('cours.client.lesson.lesson', [
            'numero' => $numero,
            'prev_content' =>  $lesson->contents[$numero - 2] ?? null,
            'lesson' => $lesson,
            'content' => $content,
            'next_content' => $lesson->contents[$numero] ?? null
        ]);
    }

    function user_question(Request $request, Lesson $lesson)
    {
        $data = $request->validate([
            'question' => ['required', 'string', 'min:2']
        ]);
        $data['lesson_id'] = $lesson->id;
        $data['user_id'] = auth()->user()->id;
        try {
            $userQuestion = UserQuestion::create($data);
        } catch (Exception $e) {
            throw $e;
        }
        if ($userQuestion) {
            return back()->with('success', 'votre question et bien ete envoyer');
        }
        return back()->with('error', 'Une erreur est survenue');
    }

    function exercice_corretion(Request $request, Exercice $exercice)
    {
        $data = $request->input();
        $note = 0;
        $note_total = 0;
        foreach ($exercice->questions as $question_index => $question) {
            $type = (\App\Helpers\TypeQuestion::typeQuestion($question));
            switch (\App\Helpers\TypeQuestion::typeQuestion($question)) {
                case 1:

                    foreach ($question['options'] as $option_index => $option) {
                        if ($option['is_correct']) {
                            $note_total++;
                            if (array_key_exists("question_{$question_index}", $data)) {
                                if ($option['response_text'] == $data["question_{$question_index}"]) {
                                    $note++;
                                }
                            }
                        }
                    }
                    break;
                case 2:
                    foreach ($question['options'] as $option_index => $option) {

                        if ($option['is_correct']) {
                            $note_total++;
                            //dd($option_index,$data["question_{$question_index}"]);
                            if (array_key_exists("$option_index", $data["question_{$question_index}"])) {
                                $note++;
                            }
                            if ($option['response_text'] == $data["question_{$question_index}"]) {
                                $note++;
                            }
                        } else {
                            if (array_key_exists("$option_index", $data["question_{$question_index}"])) {
                                $note--;
                            }
                        }
                    }
                    break;
                case 3:
                    if ($question['options'][0]['is_correct']) {
                        $note_total++;
                        if (trim(strtolower($data["question_{$question_index}"])) == trim(strtolower($question['options'][0]['response_text']))) {
                            $note++;
                        }
                    }
                    break;
            }
        }

        $exercice->users()->attach(auth()->user()->id, [
            'note' => $note,
            'response' => json_encode($data),
            'note_max' => $note_total,
        ]);

        return view('cours.client.lesson.corriger-exercice', [
            'exercice' => $exercice,
            'data' => $data,
            'note' => $note,
            'note_total' => $note_total
        ]);
    }


    function mes_cours()
    {
        $lessons = auth()->user()->lessons;
        return view('cours.client.lesson.mes-cours', [
            'lessons' => $lessons,
        ]);
    }

    function soumettre(Request $request, Evaluation $evaluation)
    {
        $note = 0;
        $data = $request->input();
        foreach ($evaluation->questions as $question) {
            switch (Question::type_question($question)) {
                case 1:
                    if (array_key_exists("question_{$question->id}", $data)) {
                        $note = $note + $question->corrige_type_1($data["question_{$question->id}"]);
                    }
                    break;
                case 2:
                    if (array_key_exists("question_{$question->id}", $data)) {
                        $note = $note + $question->corrige_type_2($data["question_{$question->id}"]);
                    }
                    break;
                case 3:
                    if (array_key_exists("question_{$question->id}", $data)) {
                        $note = $note + $question->corrige_type_3($data["question_{$question->id}"]);
                    }
                    break;
            }
        }
        /** @var User $user description */
        $user = auth()->user();
        $old_soumition = $user->soumitions()->where('evaluation_id',$evaluation->id)->get();
        if(count($old_soumition)==0){
            $Soumition = Soumition::create([
                'response'=>$data,
                'note'=>$note,
                'evaluation_id'=>$evaluation->id,
                'user_id'=>auth()->user()->id,
            ]);
        } else {
            $Soumition = $old_soumition->last()->update([
                'response'=>$data,
                'note'=>$note,
                'evaluation_id'=>$evaluation->id,
                'user_id'=>auth()->user()->id,
            ]);
             
        }
        
        return view('cours.evaluations.correction',[
            'soumition'=>$Soumition
        ])->with('success',"Votre devoir a bien ete soumit");
    }

    function evaluations_list(Lesson $lesson){
        $evaluations = $lesson->evaluations;
        return view('cours.client.evaluations.evaluations-list',[
            'evaluations'=>$evaluations,
        ]);
    }

    function evaluation(Evaluation $evaluation){
        return view('cours.client.evaluations.devoir',[
            'evaluation'=>$evaluation,
        ]);
    }

    function evaluation_voir(Evaluation $evaluation){
        $soumition = $evaluation->soumitions()->where('user_id',auth()->user()->id)->get()->last();
        
        return view('cours.evaluations.correction',[
            'soumition'=>$soumition
        ]);
    }

    function appreciation(Lesson $lesson,Request $request){
        $lesson->addApreciation($request->input('apreciation'));
        return back();
    }

    function like(Lesson $lesson){
        $lesson->addLike();
        return back();
    }


}
