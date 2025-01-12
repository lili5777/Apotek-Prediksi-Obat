<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Periode;
use App\Models\Periode_obat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function hapusobat($id)
    {
        $obat = Obat::find($id);
        $obat->delete();
        return redirect()->route('dataobat')->with('success', 'obat created successfully.');
    }

    public function dataperiode()
    {
        $periode = Periode::all();
        $obat = Obat::all();
        $jumlah = Periode_obat::all()->groupBy('id_periode');
        return view('admin.dataperiode', compact('obat', 'periode', 'jumlah'));
    }
    public function postperiode(Request $request)
    {
        $request->validate([
            'periode' => 'required|date',
            'id_obat.*' => 'required|exists:obats,id',
            'jumlah.*' => 'required|integer|min:0',
        ]);

        $periode = new Periode();
        $periode->periode = $request->periode . '-01';
        $periode->save();

        $obat = $request->id_obat;
        $jumlah = $request->jumlah;

        foreach ($obat as $key => $id_obat) {
            $jumlah_obat = $jumlah[$key];  // Ambil jumlah berdasarkan index
            if ($jumlah_obat > 0) {
                Periode_obat::create([
                    'id_periode' => $periode->id,
                    'id_obat' => $id_obat,
                    'jumlah' => $jumlah_obat,
                ]);
            }
        }

        return redirect()->route('dataperiode')->with('success', 'Periode berhasil disimpan.');
    }

    public function datapegawai()
    {
        $user = User::all();
        return view('admin.datapegawai', compact('user'));
    }
    public function postpegawai(Request $request)
    {
        // dd(vars: $request->all());
        if ($request->id) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'level' => 'required',
            ]);
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->level = $request->level;

            $user->save();
            return redirect()->route('datapegawai')->with('success', 'pegawai updated successfully.');
        }


        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'username' => 'required',
            'level' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->level = $request->level;
        $user->save();
        return redirect()->route('datapegawai')->with('success', 'pegawai created successfully.');
    }

    public function hapuspegawai($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('datapegawai')->with('success', 'pegawai deleted successfully.');
    }

    public function perhitungan()
    {
        return view('admin.perhitungan');
    }
}
