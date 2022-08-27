<?php

namespace App\Models;

use App\Enums\TaskPriority;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'start_date',
        'due_date',
        'status',
        'priority',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
        'priority' => TaskPriority::class,
    ];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function getNotesCountAttribute()
    {
        return $this->notes()->count();
    }

    public function scopePriorityHighFirst($query)
    {
        $q = 'CASE priority';
        foreach (TaskPriority::getValues() as $key => $value) {
            $q .= " WHEN '$value' THEN $key";
        }
        $q .= ' END';

        return $query->orderByRaw($q);
    }

    public function scopeFilters($query, $filters)
    {
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['due_date'])) {
            $query->whereDate('due_date', Carbon::parse($filters['due_date'])->format('Y-m-d'));
        }
        if (isset($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }
        if (isset($filters['notes'])) {
            $query->whereHas('notes', function ($query) use ($filters) {
                $query->where('note', 'like', '%'.$filters['notes'].'%');
            });
        }
        if (isset($filters['has_notes'])) {
            $query->whereHas('notes');
        }

        return $query;
    }

    protected function startDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
            set: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }

    protected function dueDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
            set: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }
}
