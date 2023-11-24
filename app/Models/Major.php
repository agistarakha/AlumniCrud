<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_jurusan';
    public $incrementing = false;
    protected $guarded = [];

    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'jurusan', 'kode_jurusan');
    }
}
