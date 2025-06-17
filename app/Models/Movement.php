<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;
    protected $fillable = [
        'receipt_id',
        'from_user_id',
        'to_user_id',
        'action',
        'remark',
        'action_at'
    ];

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
    public function latestPullBackShare()
    {
        return $this->hasOne(Receiptshare::class, 'receipt_id', 'receipt_id')
            ->where('sender_id', auth()->id())
            ->latest(); // Gets the latest entry
    }
}
