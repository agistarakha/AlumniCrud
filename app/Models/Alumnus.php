<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnus extends Model
{
    use HasFactory;
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $guarded = [];

    public function scopeSearch($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%')->orWhere('nim', 'like', "%$search%");
        });
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'jurusan', 'kode_jurusan');
    }
}
