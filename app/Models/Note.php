<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'attachment',
        'note',
    ];

    protected $casts = [
        'attachment' => 'array',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function getAttachmentUrlAttribute()
    {
        return $this->attachment ? asset('storage/'.$this->attachment['path']) : null;
    }
}
