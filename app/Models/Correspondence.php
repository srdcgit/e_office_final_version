<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correspondence extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'file_id', 'receipt_id', 'createdBy', 'modifyBy'];

    public function receipt()
    {
        return $this->belongsTo(Receipt::class, 'receipt_id');
    }
    public function document()
    {
        return $this->belongsTo(Document::class, 'doc_id');
    }
    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }
    public function notes()
    {
        return $this->belongsTo(Notes::class, 'notes_id');
    }
}
