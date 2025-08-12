<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \App\Models\CommonChecklist $commonChecklist
 */
class CommonChecklistItem extends Model
{
    use HasFactory;
    use HasUuid;

    protected $guarded = ['id', 'common_checklist_id', 'created_at', 'updated_at'];

    protected $casts = [
        'is_checked' => 'boolean',
    ];

    public function commonChecklist(): BelongsTo
    {
        return $this->belongsTo(CommonChecklist::class);
    }

    public function checkedBy(): BelongsTo
    {
        return $this->belongsTo(HikeUser::class, 'checked_by');
    }

    public function toggleIsChecked(): void
    {
        $this->is_checked = ! $this->is_checked;
    }
}
