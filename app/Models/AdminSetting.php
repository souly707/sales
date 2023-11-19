<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'system_name', 'phone', 'photo', 'address', 'general_alert',
        'added_by', 'updated_by', 'active', 'com_code'
    ];





    /** @return string  */

    public function active()
    {
        return $this->active ? "<span class='badge bg-success'>مفعل</span>"
            : "<span class='badge bg-danger'>غير مفعل</span>";
    }
}
