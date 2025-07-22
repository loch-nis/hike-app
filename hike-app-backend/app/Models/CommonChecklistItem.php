<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \App\Models\CommonChecklist $checklist
 */
class CommonChecklistItem extends Model
{
    use HasUuid;
    use HasFactory;

    protected $guarded = ['id', 'checklist_id', 'created_at', 'updated_at'];

    public function checklist(): BelongsTo
    {
        return $this->belongsTo(CommonChecklist::class, 'checklist_id');
    }

    public function checkedBy(): BelongsTo
    {
        return $this->belongsTo(HikeUser::class, 'checked_by');
    }
}
