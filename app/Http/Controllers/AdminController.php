<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dahboard');
    }

    public function dataobat()
    {
        $obat = Obat::all();
        return view('admin.dataobat', compact('obat'));
    }
    public function postobat(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
        ]);

        if ($request->id) {
            $obat = Obat::find($request->id);
            $obat->kode = $request->kode;
            $obat->nama = $request->nama;
            $obat->kategori = $request->kategori;
            $obat->satuan = $request->satuan;
            $obat->save();
            return redirect()->route('dataobat')->with('success', 'obat updated successfully.');
        }

        $obat = new Obat();
        $obat->kode = $request->kode;
        $obat->nama = $request->nama;
        $obat->kategori = $request->kategori;
        $obat->satuan = $request->satuan;
        $obat->save();

        return redirect()->route('dataobat')->with('success', 'obat created successfully.');
    }
    public function hapusobat($id){
        $obat=Obat::find($id);
        $obat->delete();
        return redirect()->route('dataobat')->with('success', 'obat created successfully.');
    }

    public function dataperiode()
    {
        return view('admin.dataperiode');
    }

    public function datapegawai()
    {
        return view('admin.datapegawai');
    }

    public function perhitungan()
    {
        return view('admin.perhitungan');
    }
}
