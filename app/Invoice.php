<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = []; //JANGAN LUPA TAMBAHKAN CODE INI
    //AGAR DAPAT MENYIMPAN DATA KEDALAM TABLE TERKAIT

    //DEFINE ACCESSOR
    public function getTaxAttribute()
    {
        //MENDAPATKAN TAX 11% DARI TOTAL HARGA
        return ($this->total * 11) / 100;
    }

    public function getTotalPriceAttribute()
    {
        //MENDAPATKAN TOTAL HARGA BARU YANG TELAH DIJUMLAHKAN DENGAN TAX
        return ($this->total + (($this->total * 11) / 100));
    }
    //DEFINE RELATIONSHIPS
    public function customer()
    {
        //Invoice reference ke table customers
        return $this->belongsTo(Customer::class);
    }

    public function detail()
    {
        //Invoice memiliki hubungan hasMany ke table invoice_detail
        return $this->hasMany(Invoice_detail::class);
    }
}
