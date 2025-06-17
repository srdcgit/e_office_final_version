<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['file_name', 'metatags', 'fileno', 'description', 'category_id', 'subcategory_id', 'department_id', 'section_id', 'status'];

    const FILE_TYPE_PHYSICAL = 'Physical';
    const FILE_TYPE_ELECTRONIC = 'Electronic';

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
    public function Department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function Section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
