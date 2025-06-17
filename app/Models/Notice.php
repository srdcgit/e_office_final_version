<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'meta_title',
        'file_type',
        'description',
        'date',
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function notice_documents(){
        return $this->hasMany(NoticeDocument::class);
    }
}
