<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $touches = ['categories'];

    public function options()
    {
        return $this->hasMany(Option::class, 'question_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'question_categories')
            ->using(QuestionCategory::class)
            ->withTimestamps();
    }
}
