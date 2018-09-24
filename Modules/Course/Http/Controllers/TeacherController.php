<?php

namespace Modules\Course\Http\Controllers;

use App\Transformers\CourseTransformer;
use App\Transformers\TeacherTransformer;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Message;
use Modules\Course\Entities\Teacher;
use Spatie\Fractalistic\Fractal;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class TeacherController extends Controller
{
    /**
     * Display a listing of the teacher.
     *
     * @return Response
     */
    public function index()
    {
        if($user = auth()->user()){

            $paginator = Teacher::query()->paginate(6);
            $teachers = $paginator->getCollection();

            $teachers = Fractal::create()->collection($teachers, new TeacherTransformer())
                ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                ->toArray();

            return view('course::teacher_index')->with(['teachers' => $teachers]);
        }
        else{

            return view('course::teacher_index')->withErrors('Unauthorized');
        }
    }

    /**
     * Show the specified teacher.
     * 
     * @param $id
     * @return Response
     */
    public function show($id)
    {

        if($user = auth()->user()){

            $teacher = Teacher::query()->find($id);

            if($teacher) {

                //courses
                $user_courses = $user->courses()->get()->pluck('id');

                $paginator = $teacher->courses()->whereNotIn('id', $user_courses)->paginate(8);
                $courses = $paginator->getCollection();

                $courses = Fractal::create()->collection($courses, new CourseTransformer())
                    ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                    ->toArray();

                $teacher = Fractal::create()->item($teacher, new TeacherTransformer())->toArray();

                return with(['teacher' => $teacher, 'courses' => $courses]);
                return view('course::teacher_show');
            }
            else{

                abort(404, 'Teacher Not Found');
                return view('course::teacher_show')->withErrors('Course Not Found');
            }
        }
        else{

            return view('course::teacher_show')->withErrors('Unauthorized');
        }
    }

    /**
     * profile of the specified teacher.
     *
     * @param $id
     * @return Response
     */
    public function profile($id)
    {

        if($user = auth()->user()){

            $teacher = Teacher::query()->find($id);

            if($teacher) {

                // messages
                $messages = Message::query()->where('teacher_id', $teacher->id)->with('children')
                    ->with(array('user'=>function($query){
                        $query->select('id', 'first_name', 'last_name');
                    }))->get();

                // courses
                $user_courses = $user->courses()->get()->pluck('id');

                $paginator = $teacher->courses()->whereNotIn('id', $user_courses)->paginate(8);
                $courses = $paginator->getCollection();

                $courses = Fractal::create()->collection($courses, new CourseTransformer())
                    ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                    ->toArray();

                $teacher = Fractal::create()->item($teacher, new TeacherTransformer())->toArray();

                return view('course::teacher_show')->with(['teacher' => $teacher, 'courses' => $courses, 'messages' => $messages]);
            }
            else{

                abort(404, 'Teacher Not Found');
                return view('course::teacher_show')->withErrors('Course Not Found');
            }
        }
        else{

            return view('course::teacher_show')->withErrors('Unauthorized');
        }
    }
}
