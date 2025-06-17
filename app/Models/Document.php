<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Document extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $fillable = [
        'doc_id',
        'dtype',
        'document_name',
        'meta_title',
        'uploadmetatitle',
        'documentpath',
        'description',
        'comments',
        'createdBy',
        'modifyBy',
        'deletedBy',
        'status',
        'updated_at',
        'created_at'
    ];

    public function users(){
        return $this->belongsTo(User::class,'createdBy');
    }
}
