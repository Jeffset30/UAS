<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $fillable = ['buku_id', 'peminjam', 'tanggal_pinjam', 'tanggal_kembali'];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }
}
