<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'dentist_id',
        'patient_id',
        'plates',
        'ended_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
    
    public function dentist()
    {
        return $this->hasMany(Dentist::class);
    }

    public function patient()
    {
        return $this->hasMany(Patient::class);
    }
}
