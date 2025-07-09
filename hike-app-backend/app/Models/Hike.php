<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hike extends Model
{
    use HasUuid;

    // todo this is not secure for prod - perhaps add "unguarded::" to the seeder?
    protected $fillable = ['title'];

    public function hikeUsers(): HasMany
    {

        return $this->hasMany(HikeUser::class);
    }

    public function commonChecklist(): HasOne
    {
        return $this->hasOne(CommonChecklist::class);
    }
}
