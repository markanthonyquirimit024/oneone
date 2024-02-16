<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['continent', 'country_name', 'capital'];
    use HasFactory;

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
