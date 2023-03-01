<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'project_date', 'content', 'image', 'type_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isImageAUrl()
    {
        return filter_var($this->image, FILTER_VALIDATE_URL);
    }
}
