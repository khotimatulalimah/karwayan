<?php

namespace App\Http\Controllers;

use App\Models\ModelLaporan; // Mengimpor model Post
use Illuminate\Http\Request; // Mengimpor kelas Request untuk menangani permintaan HTTP

class ControllerLaporan extends Controller
{

    public function destroy(ModelLaporan $post) {
        // Menghapus entri laporan dari database
        $post->delete();
    
        // Mengarahkan kembali ke halaman laporan setelah penghapusan
        return redirect()->route('laporan')->with('success', 'Laporan berhasil dihapus');
    }
    
    public function showEditScreen(ModelLaporan $post) {
        return view('editLaporan', ['post' => $post]); // Mengirim data laporan ke view 'editLaporan'
    }
    
    // Metode untuk membuat entri data baru
    public function createPost(Request $request) {
        // Validasi data yang diterima dari permintaan
        $incomingField = $request->validate([
            'nama_karyawan' => 'required', // Kolom nama_karyawan harus diisi
            'tanggal' => 'required', // Kolom tanggal harus diisi
            'pendapatan' => 'required|numeric' // Kolom pendapatan harus diisi
        ]);

        // Menghilangkan tag HTML dari input untuk keamanan
        $incomingField['nama_karyawan'] = strip_tags($incomingField['nama_karyawan']);
        $incomingField['tanggal'] = strip_tags($incomingField['tanggal']);
        $incomingField['pendapatan'] = strip_tags($incomingField['pendapatan']);
        
        // Menyimpan data baru ke database
        ModelLaporan::create($incomingField);
        
        // Mengarahkan kembali ke halaman laporan setelah penyimpanan
        return redirect()->route('laporan');
    }

    // Metode untuk meng-update entri data laporan
    public function actuallyUpdatePost(Request $request, ModelLaporan $post) {
        // Validasi data yang diterima dari permintaan
        $incomingField = $request->validate([
            'nama_karyawan' => 'required', // Kolom nama_karyawan harus diisi
            'tanggal' => 'required', // Kolom tanggal harus diisi
            'pendapatan' => 'required|numeric' // Kolom pendapatan harus diisi
        ]);

        // Menghilangkan tag HTML dari input untuk keamanan
        $incomingField['nama_karyawan'] = strip_tags($incomingField['nama_karyawan']);
        $incomingField['tanggal'] = strip_tags($incomingField['tanggal']);
        $incomingField['pendapatan'] = strip_tags($incomingField['pendapatan']);

        // Update data laporan di database
        $post->update($incomingField);
        
        // Mengarahkan kembali ke halaman laporan setelah update
        return redirect()->route('laporan');
    }
}
