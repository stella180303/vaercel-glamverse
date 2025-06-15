<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;


Route::get('/cek-admin', function () {
    return 'Route /cek-admin berhasil!';
});
/*
|--------------------------------------------------------------------------
| Auth Routes 
|--------------------------------------------------------------------------
*/


Route::middleware('web')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// lupa password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
/*
|--------------------------------------------------------------------------
| Protected Routes (butuh login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.dashboard');
    Route::get('/ownersalon', [AdminController::class, 'ownersalon'])->name('ownersalon.dashboard');
    Route::get('/home', [AdminController::class, 'home'])->name('home.dashboard');
    Route::get('/admin/pesan', [AdminController::class, 'pesanMasuk'])->name('admin.pesan');
    
    // customer
    Route::get('/history', [HomeController::class, 'riwayatReservasi'])->name('history');
    Route::post('/home/batal_booking/{id}', [HomeController::class, 'batalBooking'])->name('home.batal_booking');
    
    // end customer

    Route::get('/admin/salon', [AdminController::class, 'listSalon'])->name('admin.listSalon');
    Route::get('/homepage', [AdminController::class, 'homepage'])->name('ownersalon.homepage');
    // owner booking
    Route::get('/ownersalon/bookings', [AdminController::class, 'listBookingsOwner'])->name('ownersalon.bookings');
    Route::get('/ownersalon/batal_reservasi/{id}', [AdminController::class, 'batalReservasiOwner']);
    Route::get('/ownersalon/selesai_reservasi/{id}', [AdminController::class, 'ownerSelesaiReservasi']);
    Route::post('/ownersalon/batal_reservasi/{id}', [AdminController::class, 'batalReservasiOwner']);
    Route::get('/ownersalon/pembatalan', [AdminController::class, 'daftarPembatalan'])->name('ownersalon.pembatalan');
    Route::post('/ownersalon/pembatalan/setujui/{id}', [AdminController::class, 'setujuiPembatalan']);
    Route::post('/ownersalon/pembatalan/tolak/{id}', [AdminController::class, 'tolakPembatalan']);
        
    // Admin booking
    Route::get('/admin/bookings', [AdminController::class, 'listBookings']);
    Route::post('/admin/batalin-booking/{id}', [AdminController::class, 'batalinBooking']);
    
});

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [AdminController::class, 'home'])->name('home');


// CRUD Berita
Route::get('/listBerita', [AdminController::class, 'listBerita']);
Route::get('/tambah_berita', [AdminController::class, 'formTambahBerita']);
Route::post('/tambah_berita', [AdminController::class, 'simpanBerita']);
Route::get('/edit_berita/{id}', [AdminController::class, 'editBerita'])->name('admin.editBerita');
Route::post('/update_berita/{id}', [AdminController::class, 'updateBerita'])->name('admin.updateBerita');
Route::get('/hapus_berita/{id}', [AdminController::class, 'hapusBerita'])->name('admin.hapusBerita');
Route::get('/berita/{id}', [AdminController::class, 'detailBerita'])->name('berita.detail');

// Salon & Layanan
Route::get('/profil_salon', [AdminController::class,'profil_salon']);
Route::post('/tambah_profil', [AdminController::class,'tambah_profil']);
Route::get('/edit_profil/{id}', [AdminController::class,'edit_profil']);
Route::post('/update_profil/{id}', [AdminController::class,'update_profil']);
Route::get('/hapus_profil/{id}', [AdminController::class,'hapus_profil']);

Route::get('/view_layanan_salon', [AdminController::class,'view_layanan_salon']);
Route::get('/tambah_layanan_salon', [AdminController::class,'tambah_layanan_salon']);
Route::post('/tambah_layanan', [AdminController::class,'tambah_layanan']);
Route::get('/edit_layanan/{id}', [AdminController::class, 'edit_layanan']);
Route::post('/update_layanan/{id}', [AdminController::class, 'update_layanan']);
Route::get('/hapus_layanan/{id}', [AdminController::class, 'hapus_layanan']);

// Untuk user
Route::get('/detail_salon/{id}', [HomeController::class,'detail_salon']);
Route::get('/layanan/{id}', [HomeController::class, 'detail_layanan']);
Route::post('/pesan_layanan', [HomeController::class, 'pesan_layanan']);
Route::get('/daftarsalon', [HomeController::class, 'daftarsalon'])->name('daftarsalon');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::post('/kirim-pesan', [HomeController::class, 'kirimPesan'])->name('kirim.pesan');

// Payment Gateway
Route::post('/snap/token', [PaymentController::class,'getSnapToken']);
Route::post('/snap/finish', [PaymentController::class, 'afterPayment']);
Route::post('/snap/pay', [PaymentController::class, 'redirectToPayment']);
Route::post('/coreapi/pay', [PaymentController::class, 'payViaCoreAPI']);
