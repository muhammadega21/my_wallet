<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['rekening', 'wallet'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
