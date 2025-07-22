<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalChecklistItem extends Model
{
    use HasUuid;
    use HasFactory;

    protected $guarded = ['id', 'checklist_id', 'created_at', 'updated_at'];

    public function checklist(): BelongsTo
    {
        return $this->belongsTo(PersonalChecklist::class, 'checklist_id');
    }
}
