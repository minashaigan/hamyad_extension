<?php

namespace Modules\Tag\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTag extends Model
{
    protected $table = 'categories';

    /**
     * The tags that belong the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Modules\Tag\Entities\Tag', 'category_tag', 'category_id', 'tag_id');
    }
}
