<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schools extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ["Name", "email", "description", "type","phone_number","address","owner_id"];
}
