<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonChecklistItem extends Model
{
    use HasUuid;
    use HasFactory;

    public function checklist()
    {
        return $this->belongsTo(CommonChecklist::class, 'checklist_id');
    }

    public function checkedBy()
    {
        return $this->belongsTo(HikeUser::class, 'checked_by');
    }
}
