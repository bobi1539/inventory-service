<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "sequence",
        "icon",
        "url",
        "created_at",
        "created_by",
        "created_by_name",
        "updated_at",
        "updated_by",
        "updated_by_name",
        "is_deleted"
    ];
}
