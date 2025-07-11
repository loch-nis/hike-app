<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalChecklistItem extends Model
{
    use HasUuid;
    use HasFactory;

    protected $guarded = ['id', 'checklist_id', 'created_at', 'updated_at'];

    public function checklist()
    {
        return $this->belongsTo(PersonalChecklist::class, 'checklist_id');
    }
}
