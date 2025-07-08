<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrespondenceMovement extends Model
{
    use HasFactory;
    protected $table = 'correspondence_movements';
    protected $fillable = ['file_notes_id', 'correspondence_ids', 'remark', 'created_by'];
    protected $casts = [
        'correspondence_ids' => 'array',
    ];

    public function fileNotes()
    {
        return $this->belongsTo(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}


