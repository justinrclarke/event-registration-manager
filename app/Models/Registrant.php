<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'company_name', 'company_email', 'company_phone', 'checked_in', 'walk_in'];
}
