<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\profil_salon;
use App\Models\layanan_salon;

class OwnerSalonController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $data = profil_salon::where('user_id', $user_id)->get();
        return view('ownersalon.index', compact('data'));
    }

    public function profil_salon()
    {
        return view('ownersalon.profil_salon');
    }

    public function tambah_profil(Request $request)
    {
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

        $data = new profil_salon();
        $data->user_id = Auth::id();
        $data->nama_salon = $request->nama_salon;

        if ($request->hasFile('gambar')) {
            $namagambar = time() . '.' . $request->gambar->getClientOriginalExtension();
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

    public function view_layanan_salon()
    {
        $user_id = Auth::id();
        $profil_salon = profil_salon::where('user_id', $user_id)->first();

        if (!$profil_salon) {
            return redirect('/profil_salon')->with('message', 'Silakan lengkapi profil salon Anda terlebih dahulu.');
        }

        $data_layanan = layanan_salon::where('user_id', $user_id)->get();
        return view('ownersalon.view_layanan_salon', compact('data_layanan'));
    }

    public function tambah_layanan_salon()
    {
        return view('ownersalon.tambah_layanan_salon');
    }

    public function tambah_layanan(Request $request)
    {
        $data_layanan = new layanan_salon();
        $data_layanan->nama_layanan = $request->nama_layanan;
        $data_layanan->deskripsi_layanan = $request->deskripsi_layanan;
        $data_layanan->harga = $request->harga;
        $data_layanan->hari_tersedia = json_encode($request->hari_tersedia);
        $data_layanan->jam_tersedia = json_encode($request->jam_tersedia);

        if ($request->hasFile('gambar')) {
            $namagambar = time() . '.' . $request->gambar->getClientOriginalExtension();
            $request->gambar->move('layanan', $namagambar);
            $data_layanan->gambar = $namagambar;
        }

        $data_layanan->user_id = Auth::id();
        $data_layanan->save();

        return redirect()->back();
    }

    public function edit_layanan($id)
    {
        $layanan = layanan_salon::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('ownersalon.edit_layanan_salon', compact('layanan'));
    }

    public function update_layanan(Request $request, $id)
    {
        $layanan = layanan_salon::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->deskripsi_layanan = $request->deskripsi_layanan;
        $layanan->harga = $request->harga;
        $layanan->hari_tersedia = json_encode($request->hari_tersedia);
        $layanan->jam_tersedia = json_encode($request->jam_tersedia);

        if ($request->hasFile('gambar')) {
            $namagambar = time() . '.' . $request->gambar->getClientOriginalExtension();
            $request->gambar->move('layanan', $namagambar);
            $layanan->gambar = $namagambar;
        }

        $layanan->save();
        return redirect('/view_layanan_salon')->with('success', 'Layanan berhasil diupdate.');
    }

    public function hapus_layanan($id)
    {
        $layanan = layanan_salon::where('id', $id)->where('user_id', Auth::id())->first();
        if ($layanan) {
            $layanan->delete();
        }

        return redirect()->back()->with('success', 'Layanan berhasil dihapus.');
    }
}
