<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // A note belongs to a user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // A note belongs to a tags
    public function tag() {
        return $this->belongs(Tag::class);
    }
}
