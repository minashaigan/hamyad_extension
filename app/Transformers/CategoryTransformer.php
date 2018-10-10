<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Course\Entities\Category;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [

    ];

    /**
     * A Fractal transformer.
     *
     * @param Category $category
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id'        => $category['id'],
            'name'      => $category['name'],
            'icon'      => $category['icon']
        ];
    }

}
