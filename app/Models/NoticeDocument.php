<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'notice_id',
        'document_name',
        'file_path'
    ];

    public function notices(){
        return $this->belongsTo(Notice::class,'notice_id');
    }
}
