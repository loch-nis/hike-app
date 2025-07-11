<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function checkedItems()
    {
        return $this->hasMany(CommonChecklistItem::class);
    }
}
