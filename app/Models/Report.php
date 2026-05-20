<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    protected $fillable = [
        'user_id',
        'kategori',
        'lokasi',
        'deskripsi',
        'foto',
        'status',
    ];
}
