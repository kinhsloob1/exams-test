<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class QuestionCategory extends Pivot
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'question_categories';
}
