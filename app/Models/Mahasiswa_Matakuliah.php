<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Model\Mahasiswa;
Use App\Model\MataKuliah;

class Mahasiswa_Matakuliah extends Model
{
    use HasFactory;
    protected $table='mahasiswa_matakuliah'; 
    
    public function khs()
    {
        return $this->belongsToMany(MataKuliah::class, Mahasiswa_MataKuliah::class, 'mahasiswa_id', 'matakuliah_id')->withPivot('nilai');
    }

    public function mahasiswa(){
        return $this->belongsToMany(Mahasiswa::class);
    }
    
    public function matakuliah(){
        return $this->belongsToMany(MataKuliah::class);
    }
    

}
