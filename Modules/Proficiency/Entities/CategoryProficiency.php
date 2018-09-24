<?php

namespace Modules\Proficiency\Entities;

use Modules\Course\Entities\Category;

class CategoryProficiency extends Category
{
    protected $table = 'categories';

    /**
     * The proficiencies that belong the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function proficiencies()
    {
        return $this->belongsToMany('Modules\Proficiency\Entities\Proficiency', 'category_proficiency', 'category_id', 'proficiency_id');
    }
}
