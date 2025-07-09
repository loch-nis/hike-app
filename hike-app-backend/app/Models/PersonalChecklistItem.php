<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class PersonalChecklistItem extends Model
{
    use HasUuid;

    public function personalChecklist()
    {
        return $this->belongsTo(PersonalChecklist::class);
    }
}
