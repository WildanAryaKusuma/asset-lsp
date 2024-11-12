<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Setiap item di keranjang terhubung ke satu transaksi
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // Setiap item di keranjang mengacu pada satu produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
