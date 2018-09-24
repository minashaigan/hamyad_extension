<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Section;

class CourseTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [
        'about',
        'aboutTeacher',
        'sectionGroups',
        'sections',
        'teacherCourses'
    ];

    /**
     * A Fractal transformer.
     *
     * @param Course $course
     *
     * @return array
     */
    public function transform(Course $course)
    {
        // time
        $section_groups = $course->section_groups()->pluck('id')->toArray();
        $time = array_sum(Section::query()->whereIn('section_group_id', $section_groups)->pluck('time')->toArray());

        // rate
        $users_course = $course->users()->wherePivot('rate', '!=', null);
        $sum = array_sum($users_course->get()->pluck('pivot.rate')->toArray());
        if($users_course->count()){
            $rate = $sum/$users_course->count();
        }
        else{
            $rate = 0;
        }

        // skills
        $skills = $course->skills()->pluck('name')->toArray();

        // category
        $category = $course->category()->first();

        // teacher
        $teacher = $course->teacher()->first();
        return [
            'id'        => $course['id'],
            'name'      => $course['name'],
            'image'     => $course['image'],
            'category'  => $category['name'],
            'teacher'   => $teacher['first_name']." ".$teacher['last_name'],
            'time'      => $time,
            'rate'      => $rate,
            'skills'    => implode(", ", $skills),
            'price'     => $course['price'],
            'salable'   => $course['salable']
        ];
    }

    /**
     * Include about.
     *
     * @param Course $course
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeAbout(Course $course)
    {
        return $this->item($course, function (Course $course) {
            if( $course->section_groups()->count() and Section::query()->where('section_group_id', $course->section_groups()->first()->id)->count()) {
                return [
                    'users'             => $course->users()->count(),
                    'videos'            => Section::query()->whereIn('section_group_id', $course->section_groups()->pluck('id')->toArray())->count(),
                    'description'       => $course['description'],
                    'file'              => $course['file'],
                    'useful_resources'  => $course['useful_resources'],
                    'intro_video'       => Section::query()->where('section_group_id', $course->section_groups()->first()->id)->first()->link,
                ];
            }
            else{
                return [
                    'users'             => $course->users()->count(),
                    'videos'            => Section::query()->whereIn('section_group_id', $course->section_groups()->pluck('id')->toArray())->count(),
                    'description'       => $course['description'],
                    'file'              => $course['file'],
                    'useful_resources'  => $course['useful_resources'],
                    'intro_video'       => null,
                ];
            }
        });
    }

    /**
     * Include teachers.
     *
     * @param Course $course
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeAboutTeacher(Course $course)
    {
        $teacher = $course->teacher()->first();
        return $this->item($teacher, function ($teacher){
            return [
                'id'            => $teacher['id'],
                'description'   => $teacher['description']
            ];
        });
    }

    /**
     * Include section_groups.
     *
     * @param Course $course
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeSectionGroups(Course $course)
    {
        $section_groups = $course->section_groups()->orderBy('order')->get();
        return $this->collection($section_groups, function ($section_group) {
            if( Section::query()->where('section_group_id', $section_group->id)->count() ){
                return [
                    'id'            => $section_group['id'],
                    'name'          => $section_group['name'],
                    'time'          => Section::query()->where('section_group_id', $section_group->id)->first()->time,
                ];
            }
            else{
                return [
                    'id'            => $section_group['id'],
                    'name'          => $section_group['name'],
                    'time'          => 0,
                ];
            }
        });
    }

    /**
     * Include sections.
     *
     * @param Course $course
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeSections(Course $course)
    {
        $section_groups = $course->section_groups()->orderBy('order')->pluck('id')->toArray();
        $sections = Section::query()->whereIn('section_group_id', $section_groups)->get();
        return $this->collection($sections, function ($section) {
            return [
                'id'                => $section['id'],
                'name'              => $section['name'],
                'link'              => $section['link'],
                'description'       => $section['description'],
                'file'              => $section['file'],
                'cover'             => $section['cover'],
                'time'              => $section['time'],
                'section_group_id'  => $section['section_group_id']
            ];
        });
    }

    /**
     * Include teacher Courses.
     *
     * @param Course $course
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTeacherCourses(Course $course)
    {
        $teacher = $course->teacher()->first();
        $courses = $teacher->courses()->get();
        return $this->collection($courses, function (Course $course) {
            // time
            $section_groups = $course->section_groups()->pluck('id')->toArray();
            $time = array_sum(Section::query()->whereIn('section_group_id', $section_groups)->pluck('time')->toArray());

            // rate
            $users_course = $course->users()->wherePivot('rate', '!=', null);
            $sum = array_sum($users_course->get()->pluck('pivot.rate')->toArray());
            if($users_course->count()){
                $rate = $sum/$users_course->count();
            }
            else{
                $rate = 0;
            }

            // skills
            $skills = $course->skills()->pluck('name')->toArray();

            // category
            $category = $course->category()->first();

            // teacher
            $teacher = $course->teacher()->first();
            return [
                'id'        => $course['id'],
                'name'      => $course['name'],
                'image'     => $course['image'],
                'category'  => $category['name'],
                'teacher'   => $teacher['first_name']." ".$teacher['last_name'],
                'time'      => $time,
                'rate'      => $rate,
                'skills'    => implode(", ", $skills),
                'price'     => $course['price'],
                'salable'   => $course['salable']
            ];
        });
    }
}