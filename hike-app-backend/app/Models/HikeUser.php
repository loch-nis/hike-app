<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class HikeUser extends Model
{
    use HasUuid;

    public $timestamps = false;

    protected $fillable = [
        'hike_id',
        'user_id',
        'role',
        'joined_at',
    ];

    public function personalChecklists()
    {
        return $this->hasOne(PersonalChecklist::class);
    }

    public function checkedItems()
    {
        return $this->hasMany(CommonChecklistItem::class);
    }
}
