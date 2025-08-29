<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hike extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = ['title'];

    public function commonChecklist(): HasOne
    {
        return $this->hasOne(CommonChecklist::class);
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            HikeUser::class,
            'hike_id',
            'id',
            'id',
            'user_id',
        );
    }

    public function personalChecklistFor(User $user): PersonalChecklist
    {
        // todo also a great case for eager loading with the personalChecklist I believe
        $hikeUser = $this->hikeUsers()
            ->where('user_id', $user->id)
            ->firstOrFail();

        return $hikeUser->personalChecklist()->firstOrFail();
    }

    public function hikeUsers(): HasMany
    {

        return $this->hasMany(HikeUser::class);
    }

    public function firstPersonalChecklistItem(): PersonalChecklistItem
    {
        return $this->hikeUsers->first()->personalChecklist->personalChecklistItems->first();
    }

    public function firstCommonChecklistItem(): CommonChecklistItem
    {
        return $this->commonChecklist->commonChecklistItems->first();
    }
}
