<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class CommonChecklistItem extends Model
{
    use HasUuid;

    public function commonChecklist()
    {
        return $this->belongsTo(CommonChecklist::class);
    }

    public function checkedBy()
    {
        return $this->belongsTo(HikeUser::class, 'checked_by');
    }
}
