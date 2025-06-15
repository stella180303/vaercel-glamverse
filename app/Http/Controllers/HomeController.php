<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\profil_salon;
use App\Models\layanan_salon;
use App\Models\Booking;
use App\Models\Salon_user;
use App\Models\User;
use App\Models\Berita;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function detail_salon($id){
        $profil_salon = profil_salon::with('layanan')->where('id', $id)->first();
        return view('home.detail_salon', compact('profil_salon'));  
    }

    //milih layanan dari detial salon
    public function detail_layanan($id)
    {
        $layanan = layanan_salon::findOrFail($id);
        return view('home.detail_layanan', compact('layanan'));
    }

    //submit form pesan
    public function pesan_layanan(Request $request)
    {
        $request->validate([
            'layanan_id' => 'required|exists:layanan_salon,id',
            'nama' => 'required|string|max:255',
            'nomor_whatsapp' => 'required|string|max:20',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'metode_pembayaran' => 'required|string',
        ]);

        Booking::create([
            'layanan_id' => $request->layanan_id,
            'nama' => $request->nama,
            'nomor_whatsapp' => $request->nomor_whatsapp,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'metode_pembayaran' => $request->metode_pembayaran,
            'user_id' => auth()->id(),
        ]);

        return redirect('/')->with('success', 'Pemesanan berhasil dikirim!');
    }

    public function riwayatReservasi()
    {

         $bookings = Booking::where('user_id', auth()->id())
            ->with('layanan.profil_salon')
            ->latest()
            ->paginate(5);
        return view('home.history', compact('bookings'));
       
    }

    public function batalBooking(Request $request, $id)
    {
        $booking = Booking::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if ($booking->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk membatalkan booking ini.');
        }

        if ($booking->status_pembatalan) {
            return back()->with('warning', 'Pembatalan sudah diajukan sebelumnya.');
        }

        $booking->status_pembatalan = 'menunggu';
        $booking->alasan_pembatalan = $request->alasan ?? 'Tanpa alasan';
        $booking->save();

        return redirect()->back()->with('success', 'Permintaan pembatalan telah dikirim.');
    }

    public function daftarsalon()
    {
        $profil_salon = profil_salon::with('layanan')->paginate(9); // pakai pagination jika datanya banyak
        return view('home.daftarsalon', compact('profil_salon'));
    }

    
    //reminder WHATSAPP
    public function kirimReminderWA($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $this->sendWA($booking->nomor_whatsapp, "Halo {$booking->nama}, jangan lupa reservasi salon kamu tanggal {$booking->tanggal} jam {$booking->jam} ya. Ditunggu 💇✨");

        return back()->with('success', 'Reminder berhasil dikirim ke WhatsApp');
    }

    public function sendWA($nomor_whatsapp, $message)
    {
        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN')
        ])->post('https://api.fonnte.com/send', [
            'target' => $nomor_whatsapp,
            'message' => $message,
        ]);

        return $response->json();
    }

    // end reminder whatsapp

    // page berita
    public function berita()
    {
        $berita = Berita::latest()->paginate(6); // Atur pagination sesuai kebutuhan
        return view('home.list_berita', compact('berita'));
    }

    // send meseges
    public function kirimPesan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);
        
        ContactMessage::create($request->only('name', 'email', 'phone', 'message'));
        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }
}
