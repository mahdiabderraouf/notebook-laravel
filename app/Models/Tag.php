<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    // A tag belongs to a user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // A tag has many notes
    public function notes() {
        return $this->belongsToMany(Note::class);
    }
}
