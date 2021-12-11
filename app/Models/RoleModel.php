<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

/**
 *
 * App\Models\Course
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Course filter($input = [], $filter = null)
 * @mixin Eloquent
 */
class RoleModel extends Role
{
    use HasFactory,Filterable;

    protected $table="roles";
}
