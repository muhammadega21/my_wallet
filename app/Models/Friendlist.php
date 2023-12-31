<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendlist extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user', 'notif'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notif()
    {
        return $this->belongsTo(Notification::class);
    }
}
