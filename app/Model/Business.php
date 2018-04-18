<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Util\StringUtil;

class Business extends Model
{
    protected $table = 'business';

    protected $fillable = [
        'name',
        'slug',
        'user_id'
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = StringUtil::makeSlug($value);
    }
}
