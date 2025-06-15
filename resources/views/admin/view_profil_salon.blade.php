<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\profil_salon;
use App\Models\layanan_salon;
use App\Models\Salon_user;
use App\Models\Berita;
use App\Models\ContactMessage;

class AdminController extends Controller
{
    // public function index(){

    //     if(Auth::id()){
    //         $usertype = Auth()->user()->usertype;
    //         if($usertype == 'user')
    //         {
    //             $profil_salon = profil_salon::all();
    //             return view('home.index', compact('profil_salon'));
    //         }
    //         else if($usertype == 'admin')
    //         {
    //             $data = profil_salon::all();
    //             return view('admin.index', compact('data'));
    //         }
    //         else if($usertype == 'ownersalon')
    //         { 
    //             $user_id = Auth::id();
    //             $data_layanan = layanan_salon::all();
    //             $data = profil_salon::where('user_id', $user_id)->get();
    //             return view('ownersalon.index', compact('data'));
    //         }
    //         else 
    //         {
    //             return redirect()->back();
    //         }

    //     }

    // }

    public function ownersalon(){
        $user = Auth::user();
        $profil_salon = profil_salon::where('user_id', $user->id)->get();
    
        if ($profil_salon) {
            return view('ownersalon.index', compact('profil_salon'));
        } else {
            return redirect('/profil_salon')->with('message', 'Silakan lengkapi profil salon Anda terlebih dahulu.');
        }
    }

    public function home()
    {
        $data = profil_salon::all();
        $profil_salon = profil_salon::with('layanan')->get();
        $berita = Berita::latest()->get();

        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                return view('admin.index', compact('data', 'profil_salon', 'berita'));
            } elseif ($usertype == 'ownersalon') {
                $user_id = Auth::id();
                $data = profil_salon::where('user_id', $user_id)->get();
                return view('ownersalon.index', compact('data'));
            } elseif ($usertype == 'user') {
                return view('home.index', compact('data', 'profil_salon', 'berita')); 
            }
        }

        //(belum login)
        return view('home.index', compact('data', 'profil_salon', 'berita'));
    }

    public function profil_salon(){ 
        $user_id = Auth::id();
        $data_layanan = layanan_salon::all();
        $data = profil_salon::where('user_id', $user_id)->get();
        return view('ownersalon.profil_salon');
    }

    public function tambah_profil(Request $request){
       $data = new profil_salon();
       $data->user_id = Auth::id();

       $request->validate([
        'nama_salon' => 'required',
        'gambar' => 'required|image',
        'alamat' => 'required',
        'jam_buka' => 'required',
        'jam_tutup' => 'required',
        'hijab_room' => 'required',
        'produk' => 'required',
        'aksesibilitas' => 'required',
        'pembayaran' => 'required',
        'makanan_dan_minuman' => 'required',
        ]);

       $data->nama_salon = $request->nama_salon;
       
       $gambar = $request->gambar;
        if($gambar){
            $namagambar = time(). '.' . $gambar->getClientOriginalExtension();
            $request->gambar->move('profil', $namagambar);
            $data->gambar = $namagambar;
        }

       $data->alamat = $request->alamat;
       $data->jam_buka = $request->jam_buka;
       $data->jam_tutup = $request->jam_tutup;
       $data->hijab_room = $request->hijab_room;
       $data->produk = $request->produk;
       $data->aksesibilitas = $request->aksesibilitas;
       $data->pembayaran = $request->pembayaran;
       $data->makanan_dan_minuman = $request->makanan_dan_minuman;

       $data->save();
       return redirect()->back();
    }

    public function view_profil_salon(){
        $user_id = Auth::id();
        $data = profil_salon::where('user_id', $user_id)->get(); // ✅ filter
        return view('ownersalon.view_profil_salon', compact('data'));
    }

    public function homepage(){
        $data = profil_salon::all();$user_id = Auth::id();
        $data = profil_salon::where('user_id', $user_id)->get();
        return view('ownersalon.index', ['data'=>$data]);
    }

    public function super_homepage(){
        $data = profil_salon::all();
        return view('admin.index', ['data'=>$data]);
    }

    public function hapus_profil($id) {
        $data = profil_salon::where('id', $id)->where('user_id', Auth::id())->first();

        if ($data) {
            $data->delete();
        }

        return redirect()->back();
    }

    public function edit_profil($id){
        $data = profil_salon::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan atau Anda tidak punya akses.');
        }
    
        return view('admin.edit_profil', compact('data'));
    }

    public function update_profil(Request $request, $id){
        $data = profil_salon::find($id);
        $data->nama_salon = $request->nama_salon;

        $gambar = $request->gambar;
        if($gambar){
            $namagambar = time(). '.' . $gambar->getClientOriginalExtension();
            $request->gambar->move('profil', $namagambar);
            $data->gambar = $namagambar;
        }

        $data->alamat = $request->alamat;
        $data->jam_buka = $request->jam_buka;
        $data->jam_tutup = $request->jam_tutup;
        $data->hijab_room = $request->hijab_room;
        $data->produk = $request->produk;
        $data->aksesibilitas = $request->aksesibilitas;
        $data->pembayaran = $request->pembayaran;
        $data->makanan_dan_minuman = $request->makanan_dan_minuman;
        $data->save();
        return redirect()->back();
    }

    public function view_layanan_salon(){
        $user_id = Auth::id();
        
        $profil_salon = profil_salon::where('user_id', $user_id)->first();

        if (!$profil_salon) {
            return redirect('/profil_salon')->with('message', 'Silakan lengkapi profil salon Anda terlebih dahulu.');
        }

        $data_layanan = layanan_salon::where('user_id', $user_id)->get();

        return view('ownersalon.view_layanan_salon', compact('data_layanan'));
    }

    public function tambah_layanan_salon(){
        return view('ownersalon.tambah_layanan_salon');
    }


    public function tambah_layanan(Request $request){

        //    'nama_layanan',
        //     'deskripsi_layanan',
        //     'harga'


        $data_layanan = new layanan_salon();
        $data_layanan->nama_layanan = $request->nama_layanan;
        $data_layanan->deskripsi_layanan = $request->deskripsi_layanan;
        $data_layanan->harga = $request->harga;
        $data_layanan->hari_tersedia = json_encode($request->hari_tersedia);
        $data_layanan->jam_tersedia = json_encode($request->jam_tersedia);

        $gambar = $request->gambar;
        
        if($gambar){
            $namagambar = time(). '.' . $gambar->getClientOriginalExtension();
            $request->gambar->move('layanan', $namagambar);
            $data_layanan->gambar = $namagambar;
        }

        $data_layanan->user_id = Auth::id(); 
        $data_layanan->save();
        return redirect()->back();
    }

    public function edit_layanan($id)
    {
        $data_layanan = layanan_salon::find($id);
        if (!$data_layanan || $data_layanan->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan atau tidak punya akses.');
        }

        return view('ownersalon.edit_layanan_salon', ['layanan' => $data_layanan]);
    }

    public function update_layanan(Request $request, $id)
    {
        $data_layanan = layanan_salon::find($id);
        if (!$data_layanan || $data_layanan->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan atau tidak punya akses.');
        }

        $data_layanan->nama_layanan = $request->nama_layanan;
        $data_layanan->deskripsi_layanan = $request->deskripsi_layanan;
        $data_layanan->harga = $request->harga;
        $data_layanan->hari_tersedia = json_encode($request->hari_tersedia);
        $data_layanan->jam_tersedia = json_encode($request->jam_tersedia);

        $gambar = $request->gambar;
        if ($gambar) {
            $namagambar = time(). '.' . $gambar->getClientOriginalExtension();
            $request->gambar->move('layanan', $namagambar);
            $data_layanan->gambar = $namagambar;
        }

        $data_layanan->save();

        return redirect('/view_layanan_salon')->with('success', 'Layanan berhasil diupdate.');
    }

    public function hapus_layanan($id)
    {
        $data_layanan = layanan_salon::where('id', $id)->where('user_id', Auth::id())->first();
        if ($data_layanan) {
            $data_layanan->delete();
        }

        return redirect()->back()->with('success', 'Layanan berhasil dihapus.');
    }

    public function listSalon() {
        $data = profil_salon::all();
        return view('admin.view_profil_salon', compact('data'));
    }

    // berita
    public function listBerita() {
        $data = Berita::all();
        return view('admin.list_berita', compact('data'));
    }

    public function formTambahBerita() {
        return view('admin.tambah_berita');
    }

    public function simpanBerita(Request $request) {
        $request->validate([
            'judul' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'link' => 'nullable|url',
        ]);

        $gambar = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
        $gambar->move('gambar_berita', $namaGambar);

        Berita::create([
            'judul' => $request->judul,
            'author' => $request->author,
            'gambar' => $namaGambar,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'link' => $request->link,
        ]);

        return redirect('/listBerita')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function editBerita($id) {
        $berita = Berita::findOrFail($id);
        return view('admin.edit_berita', compact('berita'));
    }

    public function updateBerita(Request $request, $id) {
        $request->validate([
            'judul' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'link' => 'nullable|url',
        ]);

        $berita = Berita::findOrFail($id);

        $berita->judul = $request->judul;
        $berita->author = $request->author;
        $berita->deskripsi = $request->deskripsi;
        $berita->tanggal = $request->tanggal;
        $berita->link = $request->link;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('gambar_berita', $namaGambar);
            $berita->gambar = $namaGambar;
        }

        $berita->save();

        return redirect('/listBerita')->with('success', 'Berita berhasil diperbarui!');
    }

    public function hapusBerita($id) {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar && file_exists(public_path('gambar_berita/' . $berita->gambar))) {
            unlink(public_path('gambar_berita/' . $berita->gambar));
        }

        $berita->delete();

        return redirect('/listBerita')->with('success', 'Berita berhasil dihapus!');
    }

    public function detailBerita($id)
    {
        $berita = Berita::findOrFail($id);
        return view('home.detail_berita', compact('berita'));
    }
    // end berita


    // admin list booking dan pembatalan
    public function listBookings()
    {
        $bookings = Booking::with('layanan')->get();
        return view('admin.list_bookings', compact('bookings'));
    }

    public function batalinBooking(Request $request, $id)
    {
        $booking = Booking::find($id);
        $booking->status_layanan = 'dibatalkan';
        $booking->alasan_pembatalan = $request->alasan;
        $booking->status_pembatalan = 'disetujui'; 
        $booking->save();

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
    public function admin()
    {
        $data = profil_salon::all();
        return view('admin.index', compact('data'));
    }

    // owner salon booking
    public function listBookingsOwner()
    {
        $userId = Auth::id();
        $profilSalon = profil_salon::where('user_id', $userId)->first();

        if (!$profilSalon) {
            return redirect('/profil_salon')->with('message', 'Silakan lengkapi profil salon Anda terlebih dahulu.');
        }
        $layananIds = layanan_salon::where('user_id', $userId)->pluck('id');
        $bookings = Booking::with(['layanan', 'layanan.profil_salon'])
                    ->whereIn('layanan_id', $layananIds)
                    ->orderByDesc('tanggal')
                    ->paginate(10);

        return view('ownersalon.list_booking', compact('bookings'));
    }
    
    // layanan uda beres apa belom
    public function batalReservasiOwner(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status_layanan = 'dibatalkan';
        $booking->alasan_pembatalan = $request->alasan;
        $booking->status_pembatalan = 'disetujui';
        $booking->save();

        return redirect()->back()->with('success', 'Booking berhasil dibatalkan.');
        }

    public function ownerSelesaiReservasi($id)
    {
        $booking = Booking::find($id);

        if ($booking && $booking->layanan->user_id === Auth::id()) {
            $booking->status_layanan = 'selesai';
            $booking->save();
        }

        return redirect()->back()->with('success', 'Booking ditandai selesai.');
    }


    // list pembatalan
    public function daftarPembatalan()
    {
        $userId = auth()->id();
        $bookings = \App\Models\Booking::whereHas('layanan.profil_salon', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('status_pembatalan', 'menunggu')->with('layanan.profil_salon')->get();

        return view('ownersalon.pembatalan', compact('bookings'));
    }

    public function setujuiPembatalan($id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $booking->status_pembatalan = 'disetujui';
        $booking->status_layanan = 'dibatalkan';
        $booking->save();

        // send wa
         $this->sendWA($booking->nomor_whatsapp, "Hai {$booking->nama}, permintaan pembatalan reservasi kamu telah disetujui. Silakan hubungi salon terkait untuk proses refund. 🙏");

        return back()->with('success', 'Pembatalan telah disetujui.');
    }

    public function tolakPembatalan($id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $booking->status_pembatalan = 'ditolak';
        $booking->save();
        
        $this->sendWA($booking->nomor_whatsapp, "Hai {$booking->nama}, maaf, permintaan pembatalan reservasi kamu ditolak. Jika ada kendala, silakan hubungi salon. 🙏");

        return back()->with('success', 'Pembatalan telah ditolak.');
    }

    // send wa ke cust
    public function sendWA($nomor_whatsapp, $message)
    {
        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN') // taruh token kamu di .env
        ])->post('https://api.fonnte.com/send', [
            'target' => $nomor_whatsapp,
            'message' => $message,
        ]);

        return $response->json();
    }

    // contact ke admin
    public function pesanMasuk()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.pesan', compact('messages'));
    }
}