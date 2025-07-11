<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HikeUser extends Model
{
    use HasUuid;
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'hike_id',
        'user_id',
        'role',
        'joined_at',
    ];

    public function personalChecklist(): HasOne
    {
        return $this->hasOne(PersonalChecklist::class);
    }

    // todo I dont think this works? perhaps test
    public function checkedItems(): HasMany
    {
        return $this->hasMany(CommonChecklistItem::class);
    }

    // todo not sure if correct?? YES BBY it isssss
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
