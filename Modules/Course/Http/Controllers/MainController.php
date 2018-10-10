<?php

namespace Modules\Course\Http\Controllers;

use App\Transformers\CategoryTransformer;
use App\Transformers\CourseTransformer;
use Illuminate\Routing\Controller;
use Modules\Course\Entities\Category;
use Modules\Course\Entities\Course;
use Modules\Organization\Entities\Organization;
use Spatie\Fractalistic\Fractal;

class MainController extends Controller
{
    public function home()
    {
        if($user = auth()->user()){

            // courses
            $user_courses = $user->courses()->get()->pluck('id');

//            $courses = Course::query()->whereNotIn('id', $user_courses)->get();
            $courses = Course::all();

            /// new courses
            $new_courses = $courses->sortBy('created_at')->take(6)->values()->all();

            $new_courses = Fractal::create()->collection($new_courses, new CourseTransformer())
                ->toArray();

            /// popular courses
            foreach ($courses as $course){
                $course['likes'] = $course->favorites()->count();
            }

            $popular_courses = $courses->sortByDesc('likes')->take(6)->values()->all();

            $popular_courses = Fractal::create()->collection($popular_courses, new CourseTransformer())
                ->toArray();

            /// coming soon courses
            $soon_courses = Course::query()->whereNotIn('id', $user_courses)->where('coming_soon', 1)->get();

            $soon_courses = Fractal::create()->collection($soon_courses, new CourseTransformer())
                ->toArray();

            // categories
            $categories = Category::all();
            $categories = Fractal::create()->collection($categories, new CategoryTransformer())
                ->toArray();

            // organizations
            $organizations = Organization::all('logo');

            return view('course::home')->with(['popular_courses' => $popular_courses, 'new_courses' => $new_courses, 'soon_courses' => $soon_courses, 'categories' => $categories, 'organizations' => $organizations]);
        }
        else{
            return view('course::home')->withErrors('Unauthorized');
        }
    }
}