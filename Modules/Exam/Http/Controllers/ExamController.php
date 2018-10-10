<?php

namespace Modules\Exam\Http\Controllers;

use App\Transformers\ExamTransformer;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Modules\Exam\Entities\Exam;
use Spatie\Fractalistic\Fractal;

class ExamController extends Controller
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
            
            $exam = Fractal::create()->item($exam, new ExamTransformer())
                ->toArray();
            
            return view('exam::exam_show')->with(['exam' => $exam]);
            
        }
        else{
            return view('exam::exam_show')->withErrors('Unauthorized');
        }
    }

}
