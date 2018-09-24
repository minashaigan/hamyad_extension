<?php

namespace Modules\Course\Http\Controllers;

use App\Transformers\CourseTransformer;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Course;
use Spatie\Fractalistic\Fractal;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class CourseController extends Controller
{
    /**
     * Display a listing of the teacher.
     * 
     * @return Response
     */
    public function index()
    {
        if($user = auth()->user()){

            $user_courses = $user->courses()->get()->pluck('id');

            $paginator = Course::query()->whereNotIn('id', $user_courses)->paginate(6);
            $courses = $paginator->getCollection();

            $courses = Fractal::create()->collection($courses, new CourseTransformer())
                ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                ->toArray();

            return view('course::course_index')->with(['courses' => $courses]);
        }
        else{

            return view('course::course_index')->withErrors('Unauthorized');
        }
    }

    /**
     * Show the specified course.
     * 
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        
        if($user = auth()->user()){

            $course = Course::query()->find($id);

            if($course) {
                $skills = $course->skills()->pluck('name')->toArray();

                $user_courses = $user->courses()->get()->pluck('id');
                
                $paginator = Course::query()->whereNotIn('id', $user_courses)->where('id', '!=', $course->id)
                    ->whereHas('skills', function ($query) use ($skills) {
                        foreach ($skills as $skill) {
                            $query->where('name', 'like', $skill);
                        }
                    })->paginate(6);
                $similar_courses = $paginator->getCollection();

                $similar_courses = Fractal::create()->collection($similar_courses, new CourseTransformer())
                    ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                    ->toArray();

                $teacher = $course->teacher()->first();
                $paginator = $teacher->courses()->whereNotIn('id', $user_courses)->paginate(3);
                $teacher_courses = $paginator->getCollection();

                $teacher_courses = Fractal::create()->collection($teacher_courses, new CourseTransformer())
                    ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                    ->toArray();

                $course = Fractal::create()->item($course, new CourseTransformer())
                    ->includeAbout()
                    ->includeAboutTeacher()
                    ->includeSectionGroups()
                    ->includeSections()
                    ->includeTeacherCourses()
                    ->toArray();
                
                return view('course::course_show')->with(['course' => $course, 'similar_courses' => $similar_courses, 'teacher_courses' => $teacher_courses]);
            }
            else{

                abort(404, 'Course Not Found');
                return view('course::course_show')->withErrors('Course Not Found');
            }
        }
        else{

            return view('course::course_show')->withErrors('Unauthorized');
        }
    }
}
