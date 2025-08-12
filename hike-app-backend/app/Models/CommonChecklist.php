<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CommonChecklist extends Model
{
    use HasFactory;
    use HasUuid;

    public function hike(): BelongsTo
    {
        return $this->belongsTo(Hike::class);
    }

    public function commonChecklistItems(): HasMany
    {
        return $this->hasMany(CommonChecklistItem::class);
    }
}
