@extends('mahasiswa.layout')
@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h3><strong>KARTU HASIL STUDI (KHS)</strong></h3>
        </div>
        <div class="col-12 my-4">
            <p class="m-0"><strong>Nama:</strong> {{ $mhs->nama }}</p>
            <p class="m-0"><strong>NIM:</strong> {{ $mhs->nim }}</p>
            <p class="m-0"><strong>Kelas:</strong> {{ $mhs->kelas->nama_kelas }}</p>
            
        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <tr>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Nilai</th>
                </tr>
                @foreach ($nilai as $n)
                    <tr>
                        <td>{{$n->nama_matkul}}</td>
                        <td>{{$n->sks}}</td>
                        <td>{{$n->semester}}</td>
                        <td>{{$n->nilai}}</td>
                    </tr>
                @endforeach
                </table>
            </div>
        </ul>

        <a class="btn btn-success mt-3" href="{{ route('mahasiswa.index') }}">Kembali</a>
    </div>
@endsection