<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\profil_salon;
use App\Models\layanan_salon;
use App\Models\Salon_user;
use App\Models\Berita;

class AdminController extends Controller
{
    public function index(){

        if(Auth::id()){
            $usertype = Auth()->user()->usertype;
            if($usertype == 'user')
            {
                $profil_salon = profil_salon::all();
                return view('home.index', compact('profil_salon'));
            }
            else if($usertype == 'admin')
            {
                $data = profil_salon::all();
                return view('admin.index', compact('data'));
            }
            else if($usertype == 'ownersalon')
            { 
                $user_id = Auth::id();
                $data_layanan = layanan_salon::all();
                $data = profil_salon::where('user_id', $user_id)->get();
                return view('ownersalon.index', compact('data'));
            }
            else 
            {
                return redirect()->back();
            }

        }

    }

    public function ownersalon(){
        $user = Auth::user();
        $profil_salon = profil_salon::where('user_id', $user->id)->first();
    
        if ($profil_salon) {
            return view('home.index', compact('profil_salon'));
        } else {
            return redirect('/profil_salon')->with('message', 'Silakan lengkapi profil salon Anda terlebih dahulu.');
        }
    }

    public function home(){
        $profil_salon = profil_salon::with('layanan')->get(); // ← include data layanan
        return view('home.index', compact('profil_salon'));

    }

    public function profil_salon(){ 
        $user_id = Auth::id();
        $data_layanan = layanan_salon::all();
        $data = profil_salon::where('user_id', $user_id)->get();
        return view('ownersalon.profil_salon');
    }

    public function tambah_profil(Request $request){

    // $table->id();
    // $table->string('nama_salon')->nullable();
    // $table->string('gambar')->nullable();
    // $table->longtext('alamat')->nullable();
    // $table->string('jam_buka')->nullable();
    // $table->string('jam_tutup')->nullable();
    // $table->string('hijab_room')->default('yes');
    // $table->string('produk')->nullable();
    // $table->string('aksesibilitas')->nullable();
    // $table->string('pembayaran')->nullable();
    // $table->string('makanan_dan_minuman')->nullable();
    // $table->timestamps();

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
        $data = profil_salon::all();$user_id = Auth::id();
        $data = profil_salon::where('user_id', $user_id)->get(); // ✅ filter
        return view('ownersalon.view_profil_salon', compact('data'));
    }


    // public function super_view_profil_salon(){
    //     $data = profil_salon::all();
    //     return view('admin.view_profil_salon', compact('data'));
    // }

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
            $layanan->gambar = $namagambar;
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
        $data = \App\Models\Berita::all();
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
    // end berita

}