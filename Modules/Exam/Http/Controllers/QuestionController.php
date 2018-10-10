<?php

namespace Modules\Exam\Http\Controllers;

use App\Transformers\QuestionTransformer;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\Exam;
use Spatie\Fractalistic\Fractal;

class QuestionController extends Controller
{
    /**
     * Show the specified resource.
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        if($user = auth()->user()){

            $exam = Exam::query()->find($id);
            $questions = $exam->questions()->get();

            $questions = Fractal::create()->collection($questions, new QuestionTransformer())
                ->toArray();

            $user_questions = $user->questions()->get()->pluck('id')->toArray();
            
            return view('exam::questions_show')->with(['questions' => $questions, 'user_questions' => $user_questions]);

        }
        else{

            return view('exam::questions_show')->withErrors('Unauthorized');
        }
    }

}
