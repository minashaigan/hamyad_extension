<?php

namespace Modules\Course\Entities;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserSection extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'user_section';
    
}
