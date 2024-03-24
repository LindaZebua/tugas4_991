<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('kategori')->get();
        return view('backend.content.berita.list', compact('berita'));
    }

    public function tambah()
    {
        $kategori = Kategori::all();
        return view('backend.content.berita.formTambah', compact('kategori'));
    }

    public function prosesTambah(Request $request)
    {
        $this->validate($request, [
            'judul_berita' => 'required',
            'isi_berita' => 'required',
            'id_kategori' => 'required',
            'gambar_berita' => 'required|file|mimes:jpeg,png,jpg,gif',
        ]);

        // Store the file in the 'public' disk under the 'uploads' directory
        $path = $request->file('gambar_berita')->store('uploads', 'public');
        $gambar_berita = basename($path);

        $berita = new Berita();
        $berita->judul_berita = $request->judul_berita;
        $berita->isi_berita = $request->isi_berita;
        $berita->id_kategori = $request->id_kategori;
        $berita->gambar_berita = $gambar_berita;

        try {
            $berita->save();
            return redirect(route('berita.index'))->with('pesan', ['success', 'Berhasil tambah berita']);
        } catch (\Exception $e) {
            return redirect(route('berita.index'))->with('pesan', ['danger', 'Gagal tambah berita']);
        }
    }

    public function ubah($id)
    {
        $berita = Berita::findOrFail($id);
        $kategori = Kategori::all();
        return view('backend.content.berita.formUbah',compact('berita','kategori'));

    }

    public function prosesUbah(Request $request)
    {
        $this->validate($request, [
            'judul_berita' => 'required',
            'isi_berita' => 'required',
            'id_kategori' => 'required',

        ]);
        $berita = Berita::findOrFail($request->id_berita);
        $berita->judul_berita = $request->judul_berita;
        $berita->isi_berita = $request->isi_berita;
        $berita->id_berita = $request->id_berita;

        if ($request->hasFile('gambar_berita')){
            $request->file('gambar_berita')->store('public');
            $gambar_berita =$request->file('gambar_berita')->hashName();
            $berita->gambar_berita = $gambar_berita;
        }
        try {
            $berita->save();
            return redirect(route('berita.index'))->with('pesan', ['success', 'Berhasil ubah berita']);
        } catch (\Exception $e) {
            return redirect(route('berita.index'))->with('pesan', ['danger', 'Gagal ubah berita']);
        }

    }

    public function hapus($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            $berita->delete();

            return redirect(route('berita.index'))->with('pesan', ['success', 'Berhasil hapus berita']);
        } catch (\Exception $e) {
            return redirect(route('berita.index'))->with('pesan', ['danger', 'Gagal hapus berita']);
        }
    }
}

