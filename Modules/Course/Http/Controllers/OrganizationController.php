<?php

namespace Modules\Course\Http\Controllers;

use App\Transformers\CategoryTransformer;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Modules\Organization\Entities\Organization;
use Spatie\Fractalistic\Fractal;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the organization.
     *
     * @return Response
     */
    public function index()
    {
        $organizations = Organization::all('logo');

        return view('course::organization_index')->with(['organizations' => $organizations]);
    }

    /**
     * Show the specified course.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {

    }
}