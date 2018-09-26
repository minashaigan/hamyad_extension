<?php

namespace Modules\Course\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Course\Entities\Category;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Section;
use Modules\Course\Entities\SectionGroup;
use Modules\Course\Entities\Teacher;
use Modules\Organization\Entities\Organization;
use Modules\Skill\Entities\Skill;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // create 10 categories using the course factory
        factory(Category::class, 10)->create();
        // create 10 teachers using the course factory
        factory(Teacher::class, 10)->create();
        // create 10 courses using the course factory
        factory(Course::class, 10)->create();
        // create 10 section_groups using the course factory
        factory(SectionGroup::class, 10)->create();
        // create 10 sections using the course factory
        factory(Section::class, 10)->create();
        // create 10 skills using the course factory
        factory(Skill::class, 10)->create();
        // create 10 organization using the course factory
        factory(Organization::class, 10)->create();
    }
}
