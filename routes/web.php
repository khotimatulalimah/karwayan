<?php


use App\Models\ModelLaporan;
use Illuminate\Support\Facades\Route;
use App\Models\ModelTransaksiPenjualan;
use App\Http\Controllers\ControllerLaporan;
use App\Http\Controllers\ControllerTransaksiPenjualan;

// Route untuk menampilkan halaman kasir
Route::get('/kasir', function() {
    $posts = ModelTransaksiPenjualan::all(); // Ambil semua data transaksi
    return view('kasir', ['posts' => $posts]); // Kirim data ke view
});

// Route untuk menyimpan data transaksi
Route::post('/create-post', [ControllerTransaksiPenjualan::class, 'createPost']);


Route::get('/laporan', function() {
    $posts = ModelLaporan::all(); // Ambil semua data transaksi
    return view('laporan', ['posts' => $posts]); // Kirim data ke view
})->name('laporan'); // Memberikan nama 'laporan' pada rute
Route::get('/editLaporan/{post}',[ControllerLaporan::class, 'showEditScreen']);
Route::put('/editLaporan/{post}', [ControllerLaporan::class, 'actuallyUpdatePost']);
// Route untuk menyimpan data laporan
Route::post('/create-post-laporan', [ControllerLaporan::class, 'createPost'])->name('post.create'); // Memberikan nama 'post.create'
// Route untuk menampilkan form edit laporan
Route::get('/editLaporan/{post}', [ControllerLaporan::class, 'showEditScreen'])->name('post.edit');
// Route untuk menghapus laporan
Route::delete('/deleteLaporan/{post}', [ControllerLaporan::class, 'destroy'])->name('post.destroy');
Route::put('/editLaporan/{post}', [ControllerLaporan::class, 'actuallyUpdatePost'])->name('post.update');


Route::get('/kasir', [ControllerTransaksiPenjualan::class, 'index']);

// Route untuk menghitung pendapatan
Route::post('/calculate-revenue', [ControllerTransaksiPenjualan::class, 'calculateRevenue']);
