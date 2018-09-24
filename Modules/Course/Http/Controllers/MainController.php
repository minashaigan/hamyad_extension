<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Transformers\CourseTransformer;
use App\Transformers\TeacherTransformer;
use Illuminate\Http\Response;
use Modules\Course\Entities\Message;
use Modules\Course\Entities\Teacher;
use Spatie\Fractalistic\Fractal;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class MainController extends Controller
{

}