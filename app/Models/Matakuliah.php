<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa_Matakuliah;
Use App\Model\Mahasiswa;

class Matakuliah extends Model
{
    use HasFactory;
    protected $table='matakuliah'; 
    protected  $primaryKey = 'id'; 

    public function mahasiswa(){
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah','matakuliah_id', 'mahasiswa_id')->withPivot('nilai');
    }
}
