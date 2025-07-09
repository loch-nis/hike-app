<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class CommonChecklist extends Model
{
    use HasUuid;

    public function hike()
    {
        return $this->belongsTo(Hike::class);
    }

    public function commonChecklistItems()
    {
        return $this->hasMany(CommonChecklistItem::class);
    }
}
