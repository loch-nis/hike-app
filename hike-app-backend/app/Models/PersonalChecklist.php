<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalChecklist extends Model
{
    use HasUuid;
    use HasFactory;

    protected $fillable = ['hike_user_id'];

    public function hikeUser()
    {
        return $this->belongsTo(HikeUser::class);
    }

    public function personalChecklistItems()
    {
        return $this->hasMany(PersonalChecklistItem::class, 'checklist_id');
    }
}
