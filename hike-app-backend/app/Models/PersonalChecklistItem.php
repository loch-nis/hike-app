<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \App\Models\PersonalChecklist $personalChecklist
 */
class PersonalChecklistItem extends Model
{
    use HasFactory;
    use HasUuid;

    protected $guarded = ['id', 'personal_checklist_id', 'created_at', 'updated_at'];

    protected $casts = [
        'is_checked' => 'boolean',
    ];

    public function personalChecklist(): BelongsTo
    {
        return $this->belongsTo(PersonalChecklist::class);
    }

    public function toggleIsChecked(): void
    {
        $this->is_checked = ! $this->is_checked;
    }
}
