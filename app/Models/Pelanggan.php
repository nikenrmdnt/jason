<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $fillable = [
    'nama_lengkap',
    'no_hp',
    'alamat',
    'foto',
    'id_user',
    ];

    public function users(){
        return $this->belongsTo(User::class,'id_user', 'id', 'name', 'email');
    }
}