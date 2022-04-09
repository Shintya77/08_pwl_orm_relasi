<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Mahasiswa_Matakuliah;

class Mahasiswa extends Model 
{
    protected $table='mahasiswa'; // Eloquent akan membuat model mahasiswa menyimpan record ditabel mahasiswa
    protected  $primaryKey = 'nim'; // Memanggil isi DB Dengan primarykey
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nim', 
        'nama',
        'kelas',
        'jurusan',
        'email',
        'alamat',
        'tgl_lahir',
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function matakuliah(){
        return $this->belongsToMany(MataKuliah::class, 'mahasiswa_matakuliah', 'matakuliah_id', 'mahasiswa_id' )->withPivot('nilai');
    }
};