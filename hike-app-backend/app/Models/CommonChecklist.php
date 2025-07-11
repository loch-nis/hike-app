<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonChecklist extends Model
{
    use HasUuid;
    use HasFactory;


    public function hike()
    {
        return $this->belongsTo(Hike::class);
    }

    public function commonChecklistItems()
    {
        return $this->hasMany(CommonChecklistItem::class,
            'checklist_id'); // because it's not called common_checklist_id. Although in my next project, I should probably just follow convention to avoid this in the first place
    }
}
