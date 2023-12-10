<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'address', 'added_by', 'updated_by', 'date', 'com_code', 'active'
    ];


    /** @return string  */

    public function active()
    {
        return $this->active ? "<span class='badge bg-success'>مفعل</span>"
            : "<span class='badge bg-danger'>غير مفعل</span>";
    }
}
