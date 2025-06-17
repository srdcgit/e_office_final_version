<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    const RECEIPT_TYPE_PHYSICAL = 'Physical';
    const RECEIPT_TYPE_ELECTRONIC = 'Electronic';
    protected $fillable = [
        'computer_number',
        'receipt_status',
        'receipt_file',
        'ocr_text',
        'dairy_date',
        'form_of_communication',
        'language',
        'letter_date',
        'letter_ref_no',
        'delivery_mode',
        'mode_number',
        'sender_type',
        'vip',
        'name',
        'department',
        'designation',
        'organitation',
        'email',
        'address',
        'pin_code',
        'phone_number',
        'country',
        'state',
        'city',
        'category',
        'subcategory',
        'subject',
        'remarks',
        'created_at',
        'updated_at'
    ];
    public function delivery()
    {
        return $this->belongsTo(Deliverymode::class, 'delivery_mode');
    }
    public function sender()
    {
        return $this->belongsTo(Sendertype::class, 'sender_type');
    }
    public function dept()
    {
        return $this->belongsTo(Department::class, 'department');
    }
    public function ministry()
    {
        return $this->belongsTo(Ministry::class, 'ministry_department');
    }
    public function communication()
    {
        return $this->belongsTo(Communication::class, 'form_of_communication');
    }
    public function Vip()
    {
        return $this->belongsTo(Vip::class, 'vip');
    }
    public function Country()
    {
        return $this->belongsTo(Country::class, 'country');
    }
    public function State()
    {
        return $this->belongsTo(State::class, 'state');
    }
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category');
    }
    public function subCategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory');
    }

    public function receiptShares()
    {
        return $this->hasMany(ReceiptShare::class);
    }

    public function toRecipients()
    {
        return $this->receiptShares()->where('share_type', 'To');
    }

    public function ccRecipients()
    {
        return $this->receiptShares()->where('share_type', 'Cc');
    }
}
