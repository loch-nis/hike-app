<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PersonalChecklist extends Model
{
    use HasUuid;
    use HasFactory;

    protected $fillable = ['hike_user_id'];

    public function hikeUser(): BelongsTo
    {
        return $this->belongsTo(HikeUser::class);
    }

    public function personalChecklistItems(): HasMany
    {
        return $this->hasMany(PersonalChecklistItem::class, 'checklist_id');
    }
}
