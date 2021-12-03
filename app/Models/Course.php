<?php

namespace App\Models;

use App\StudentClassCourse;
use Carbon\Carbon;
use Eloquent;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 * App\Models\Course
 * @property int $id
 * @property string $course_title
 * @property string $course_image
 * @property integer $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Course filter($input = [], $filter = null)
 * @mixin Eloquent
 */
class Course extends Model
{
    use HasFactory,Filterable;

    protected $fillable = [
        'course_title',
        'course_image',
        'status',
    ];

    public function classes(): HasMany
    {
        return $this->hasMany(StudentClassCourse::class,'class_id');
    }
}
