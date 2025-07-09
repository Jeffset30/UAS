<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
   protected $fillable = ['judul', 'pengarang', 'kategori'];

    public function peminjamans(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function scopeTersedia($query)
    {
        return $query->whereDoesntHave('peminjamans', function ($q) {
            $q->whereNull('tanggal_kembali');
        });
    }
}
