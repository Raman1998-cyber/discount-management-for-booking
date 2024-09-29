<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFamily extends Model
{
    
    protected $fillable = ['name', 'type', 'value', 'max_uses', 'max_discount', 'recurring', 'family_member'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function familyMember()
    {
        return $this->belongsTo(User::class, 'family_member_id');
    }
}

?>