<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'is_master', 'last_receipt_exchange', 'last_receipt_collect',
        'added_by', 'updated_by', 'date', 'com_code', 'active'
    ];






    /** @return string  */

    public function active()
    {
        return $this->active ? "<span class='badge bg-success'>مفعل</span>"
            : "<span class='badge bg-danger'>غير مفعل</span>";
    }

    /** @return string  */

    public function is_master()
    {
        return $this->is_master ? "رئيسية" : "فرعية";
    }
}
