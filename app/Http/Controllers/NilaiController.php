<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Mahasiswa_Matakuliah;

class NilaiController extends Controller
{
    public function index(Mahasiswa_Matakuliah $m, $id){

        $mahasiswa = Mahasiswa::with('kelas')->find($id);
        $matakuliah = Mahasiswa_Matakuliah::where('mahasiswa_id', $mahasiswa->id_mahasiswa)->get();
        return view('mahasiswa.nilai', ['mhs'=>$mahasiswa, 'nilai'=>$matakuliah]);
   
    }
    public function nilai($nim){
        $nilai = Mahasiswa::with('kelas', 'matakuliah')->find($nim);
        return view('mahasiswa.nilai', compact('nilai'));
    }
   

}
