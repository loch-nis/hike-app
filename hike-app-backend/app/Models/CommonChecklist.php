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
        return $this->hasMany(CommonChecklistItem::class, 'checklist_id'); // because its not called common_checklist_id
    }
}
