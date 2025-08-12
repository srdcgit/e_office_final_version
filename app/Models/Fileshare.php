<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fileshare extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_id',
        'gnotes_id',
        'department_id',
        'section_id',
        'sender_id',
        'notifyby',
        'share_file_status',
        'remarks',
        'recever_id',
        'duedate',
        'actiontype',
        'priority',
        'comments',
        'status',
        'read_status',
        'is_read',
        'read_at',
        'is_pulled_back',
        'pull_back_remark',
        'createdBy',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'is_read' => 'boolean',
        'is_pulled_back' => 'boolean',
    ];

    // public function fileshare()
    // {
    //     return $this->belongsTo(File::class,'file_id');
    // }

    const VIEW = 'view';
    const EDIT = 'edit';


    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function files()
    {
        return $this->belongsTo(File::class, 'file_id');
    }
    // public function filename()
    // {
    //     return $this->belongsTo(File::class,'file_id');
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function sendto()
    {
        return $this->belongsTo(User::class, 'recever_id');
    }
    public function notes()
    {
        return $this->belongsTo(Notes::class, 'gnotes_id');
    }
}
