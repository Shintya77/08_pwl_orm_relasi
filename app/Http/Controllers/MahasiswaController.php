<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Mahasiswa_Matakuliah;


class MahasiswaController extends Controller
{
    public function index()
    {
        //yang semula Mahasiswa:all, diubah menjadi with() yang menyatakan relai
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(3);
        return view('mahasiswa.index', ['mahasiswa' => $mahasiswa, 'paginate'=>$paginate]);
    }

    public function search(Request $request){
        $keyword = $request -> search;
        $paginate = Mahasiswa::where('nama','like',"%". $keyword . "%") -> paginate(3);
        return view('mahasiswa.index', compact( 'paginate'));
    }

    public function create()
    {
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswa.create', ['kelas' => $kelas]);
    }

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            ]);

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get('nim');
        $mahasiswa->nama = $request->get('nama');
        $mahasiswa->jurusan= $request->get('jurusan');
        $mahasiswa->email= $request->get('email');
        $mahasiswa->alamat= $request->get('alamat');
        $mahasiswa->tgl_lahir= $request->get('tgl_lahir');
        //$mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');
        //fungsi eloquent untuk menambah data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
        
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    public function show($nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        //Code sebelum dibuat relasi-->$mahasiswas = Mahasiswa::find($id);
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        return view('mahasiswa.detail', ['mhs' => $mahasiswa]);;

    }

    public function edit($nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $mahasiswa = Mahasiswa::with('kelas')->where('Nim', $nim)->first();
        $kelas = kelas::all(); //mendapatkan data dari table kelas)
        return view('mahasiswa.edit', compact('mahasiswa', 'kelas'));
    }

    public function update(Request $request, $nim)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            ]);
    
            $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
            $mahasiswa->nim = $request->get('nim');
            $mahasiswa->nama = $request->get('nama');
            $mahasiswa->jurusan= $request->get('jurusan');
            $mahasiswa->email= $request->get('email');
            $mahasiswa->alamat= $request->get('alamat');
            $mahasiswa->tgl_lahir= $request->get('tgl_lahir');
            //$mahasiswa->save();
    
            $kelas = new Kelas;
            $kelas->id = $request->get('kelas');
            //fungsi eloquent untuk menambah data dengan relasi belongto
            $mahasiswa->kelas()->associate($kelas);
            $mahasiswa->save();
    
            //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Diupdate');   
    }
    public function destroy(Mahasiswa $mahasiswa)
    {
        Mahasiswa::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus');
    }
    
   
};