<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HikeUser extends Model
{
    use HasFactory;
    use HasUuid;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hike(): BelongsTo
    {
        return $this->belongsTo(Hike::class);
    }
}
