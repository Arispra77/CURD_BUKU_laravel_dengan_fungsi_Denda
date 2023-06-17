<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Helper\Table;
use Illuminate\Support\Facades\DB;
class perpus extends Controller
{
    //
    public function index(){

    
  $result = DB::table('buku')
            ->join('sirkulasi', 'buku.kode_buku', '=', 'sirkulasi.kode_buku')
            ->select('buku.kode_buku', 'buku.judul', 'sirkulasi.tgl_pinjam', 'sirkulasi.tgl_kembali', 'sirkulasi.kondisi','sirkulasi.denda')
            ->paginate(5);

            foreach ($result as $data) {
                $data->tgl_pinjam = Carbon::createFromFormat('Y-m-d', $data->tgl_pinjam)->format('d-m-Y');
                $data->tgl_kembali = Carbon::createFromFormat('Y-m-d', $data->tgl_kembali)->format('d-m-Y');
            }
                return view('index', compact('result'));
}
public function create()
{
    $kodeBuku = $this->generateKodeBuku();
  $bukus = DB::table('buku')->get();
    $sirkulasis = DB::table('sirkulasi')->get();
    return view('tambah', compact('bukus', 'sirkulasis'));


}

private function generateKodeBuku()
{
    $lastKodeBuku = DB::table('buku')->orderBy('kode_buku', 'desc')->first();

    if ($lastKodeBuku) {
        // Jika ada kode buku sebelumnya, ambil angka terakhir dan tambahkan 1
        $lastNumber = (int)substr($lastKodeBuku->kode_buku, -4);
        $newNumber = $lastNumber + 1;

        // Format angka dengan 4 digit, contoh: 0001, 0002, dst.
        $kodeBuku = str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    } else {
        // Jika belum ada kode buku, gunakan angka 1 sebagai awal
        $kodeBuku = '0001';
    }

    return $kodeBuku;
}

public function store(Request $request)
{
    if (
        empty($request->tgl_kembali) ||
        empty($request->tgl_pinjam) ||
        empty($request->kode_buku) ||
        empty($request->judul) ||
        empty($request->pengarang) ||
        empty($request->tahun) ||
        empty($request->isbn) ||
        empty($request->jml_halaman) ||
        empty($request->kondisi) ||
        empty($request->nbi)
    ) {
        $request->session()->flash('error', 'Data belum lengkap');
        return redirect()->back();
    }

    $tglKembali = Carbon::createFromFormat('d-m-Y', $request->tgl_kembali);
    $tglPinjam = Carbon::createFromFormat('d-m-Y', $request->tgl_pinjam);

    // Menghitung jumlah hari terlambat
    $jumlahHariTerlambat = $tglPinjam->diffInDays($tglKembali, false) - 30;

    // Inisialisasi jumlah denda
    $denda = 0;

    if ($jumlahHariTerlambat > 0) {
        // Menghitung jumlah denda terlambat
        $jumlahDendaTerlambat = ceil($jumlahHariTerlambat / 30) * 10000;
        $denda += $jumlahDendaTerlambat;

        if ($request->kondisi == 'RUSAK') {
            // Menambahkan denda untuk buku rusak
            $denda += 50000;
        } else {
            $denda += 0;
        }
    } elseif ($jumlahHariTerlambat < 0) {
        // Menghitung jumlah denda terlambat
        $denda += 0;

        if ($request->kondisi == 'RUSAK') {
            // Menambahkan denda untuk buku rusak
            $denda += 50000;
        } else {
            $denda += 0;
        }
    }

    $kodeBuku = $request->kode_buku ?: $this->generateKodeBuku();

    $data = [
        'kode_buku' => $kodeBuku,
        'tgl_pinjam' => $request->tgl_pinjam,
        'tgl_kembali' => $request->tgl_kembali,
        'kondisi' => $request->kondisi,
        'denda' => $denda,
        'nbi' => $request->nbi,
    ];

    DB::table('sirkulasi')->insert($data);

    return redirect('/perpus')->with('success', 'Data berhasil ditambahkan');
}


public function hapus($id)
{
    DB::table('sirkulasi')->where('kode_buku', $id)->delete();
    DB::table('buku')->where('kode_buku', $id)->delete();
    return redirect()->route('index')->with('success', 'Data berhasil dihapus');
}
public function edit($id)
{
    $buku = DB::table('buku')->where('kode_buku', $id)->first();
    $sirkulasi = DB::table('sirkulasi')->where('kode_buku', $id)->first();

    return view('edit', compact('buku', 'sirkulasi'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required',
        'tgl_pinjam' => 'required',
        'tgl_kembali' => 'required',
        'kondisi' => 'required',
    ], [
        'judul.required' => 'Judul harus diisi.',
        'tgl_pinjam.required' => 'Tanggal pinjam harus diisi.',
        'tgl_kembali.required' => 'Tanggal kembali harus diisi.',
        'kondisi.required' => 'Kondisi harus diisi.',
    ]);

    $tglKembali = Carbon::createFromFormat('Y-m-d', $request->tgl_kembali);
    $tglPinjam = Carbon::createFromFormat('Y-m-d', $request->tgl_pinjam);

    // Menghitung jumlah hari terlambat
    $jumlahHariTerlambat = $tglPinjam->diffInDays($tglKembali, false) - 30;

    // Inisialisasi jumlah denda
    $denda = 0;

    if ($jumlahHariTerlambat > 0) {
        // Menghitung jumlah denda terlambat
        $jumlahDendaTerlambat = ceil($jumlahHariTerlambat / 30) * 10000;
        $denda += $jumlahDendaTerlambat;

        if ($request->kondisi == 'RUSAK') {
            // Menambahkan denda untuk buku rusak
            $denda += 50000;
        } else {
            $denda += 0;
        }
    } elseif ($jumlahHariTerlambat < 0) {
        // Menghitung jumlah denda terlambat
        $denda += 0;

        if ($request->kondisi == 'RUSAK') {
            // Menambahkan denda untuk buku rusak
            $denda += 50000;
        } else {
            $denda += 0;
        }
    }

    DB::table('buku')->where('kode_buku', $id)->update([
        'judul' => $request->judul,
        // Update kolom lainnya
    ]);

    DB::table('sirkulasi')->where('kode_buku', $id)->update([
        'tgl_pinjam' => $request->tgl_pinjam,
        'tgl_kembali' => $request->tgl_kembali,
        'kondisi' => $request->kondisi,
        'denda' => $denda,
        // Update kolom lainnya
    ]);

    return redirect('/perpus')->with('success', 'Data berhasil diupdate');
}


}