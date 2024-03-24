<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;


class KategoriController extends Controller
{
    public function index(){
        $kategori = Kategori::all();
        //dd($kategori);
        return view('backend.content.kategori.list',compact('kategori'));

    }
    public function tambah(){
        return view('backend.content.kategori.formTambah');
    }
    public function prosesTambah(Request $request){
        $this->validate($request, [
            'nama_kategori' => 'required'
        ]);

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;

        try{
            $kategori->save();
            return redirect(route('kategori.index'))->with('pesan', ['success', 'Berhasil tambah kategori']);
        }catch (\Exception $e){
            return redirect(route('kategori.index'))->with('pesan',['denger','Gagal tambah kategori']);


        }
    }
    public function ubah($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('backend.content.kategori.formUbah', compact('kategori'));
    }
    public function prosesUbah(Request $request){
        $this->validate($request, [
            'id_kategori' => 'required',
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategori::findOrFail($request->id_kategori);
        $kategori->nama_kategori = $request->nama_kategori;

        try{
            $kategori->save();
            return redirect(route('kategori.index'))->with('pesan', ['success', 'Berhasil Ubah kategori']);
        }catch (\Exception $e){
            return redirect(route('kategori.index'))->with('pesan',['denger','Gagal Ubah kategori']);


        }

    }
    public function hapus($id){
        $kategori = Kategori::findOrFail($id);

        try{
            $kategori->delete();
            return redirect(route('kategori.index'))->with('pesan', ['success', 'Berhasil Hapus kategori']);
        }catch (\Exception $e){
            return redirect(route('kategori.index'))->with('pesan',['denger','Gagal Hapus kategori']);


        }

    }

    public function exportPdf(){
        $kategori = Kategori::all();
        $pdf = Pdf::loadView('backend.content.kategori.export', compact('kategori'));
        return $pdf->download('Data Kategori.pdf');
    }


}
