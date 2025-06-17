<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiptshare extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_id',
        'sender_id',
        'recever_id',  
        'department_id',
        'section_id',
        'share_type',
        'remark',
        'due_date',
        'action',
        'priority',
        'is_read',
        'is_pulled_back',
        'send_back',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function receipts()
    {
        return $this->belongsTo(Receipt::class, 'receipt_id');
    }
    public function receiptsComputer()
    {
        return $this->belongsTo(Receipt::class, 'receipt_id');
    }
    public function receiptsNature()
    {
        return $this->belongsTo(Receipt::class, 'receipt_id');
    }
    public function sendto()
    {
        return $this->belongsTo(Receipt::class, 'recever_id');
    }
    // public function senduser()
    // {
    //     return $this->belongsTo(User::class,'recever_id');
    // }
    public function senduser()
    {
        return $this->belongsTo(User::class, 'recever_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'recever_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
