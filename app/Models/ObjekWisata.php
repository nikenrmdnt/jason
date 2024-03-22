<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisata extends Model
{
    use HasFactory;
    protected $table = 'objek_wisata'; 
    protected $fillable = [ 
        'nama_wisata',
        'deskripsi_wisata',
        'id_kategori_wisata', 
        'fasilitas', 
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5'
    ];

    public function kategori_wisata(){
        return $this->belongsTo(KategoriWisata::class, 'id_kategori_wisata', 'id');
    } 
}