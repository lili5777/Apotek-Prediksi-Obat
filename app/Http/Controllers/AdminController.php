<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Periode;
use App\Models\Periode_obat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    public function index()
    {
        $obat = Obat::count();
        $periode = Periode::count();
        $pegawai = User::count();
        return view('admin.dahboard', compact('obat', 'periode', 'pegawai'));
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
        if (Periode_obat::count() == 0) {
            Periode::query()->delete();  // Menghapus semua data di tabel periode
        }


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
        ], [
            'jumlah.*.required' => 'Jumlah obat tidak boleh kosong.',
            'jumlah.*.integer' => 'Jumlah obat harus berupa angka.',
            'jumlah.*.min' => 'Jumlah obat tidak boleh kurang dari 0.',
        ]);

        // Cek apakah periode sudah ada di database
        $existingPeriode = Periode::where('periode', $request->periode . '-01')
            ->when($request->id, function ($query) use ($request) {
                return $query->where('id', '!=', $request->id);
            })
            ->exists();

        if ($existingPeriode) {
            return redirect()->back()->withErrors(['periode' => 'Periode sudah ada, silakan pilih periode lain.']);
        }

        if ($request->id) {
            $periode = Periode::find($request->id);
            $periode->periode = $request->periode . '-01';
            $periode->save();

            $obat = $request->id_obat;
            $jumlah = $request->jumlah;

            foreach ($obat as $key => $id_obat) {
                $jumlah_obat = $jumlah[$key];
                if ($jumlah_obat > 0) {
                    Periode_obat::updateOrCreate(
                        [
                            'id_periode' => $periode->id,
                            'id_obat' => $id_obat,
                        ],
                        [
                            'jumlah' => $jumlah_obat,
                        ]
                    );
                }
            }

            return redirect()->route('dataperiode')->with('success', 'Periode berhasil disimpan.');
        }

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

    public function hapusperiode($id)
    {
        $periode = Periode::find($id);
        $periode->delete();

        return redirect()->route('dataperiode')->with('success', 'Periode berhasil diHapus.');
    }

    public function datapegawai()
    {
        $user = User::all();
        return view('admin.datapegawai', compact('user'));
    }
    public function postpegawai(Request $request)
    {

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
        $obat = Obat::all();
        return view('admin.perhitungan', compact('obat'));
    }




    // proses perhitungan metode prophet
    public function postperhitungan(Request $request)
    {
        $request->validate([
            'obat' => 'required',
            'mulai' => 'required|date_format:Y-m',
            'selesai' => 'required|date_format:Y-m|after:mulai',
        ], [
            'selesai.after' => 'Bulan dan tahun selesai harus setelah bulan dan tahun mulai.',
        ]);

        $obat = Obat::where('id', $request->obat)->first();

        $mulai = Periode::where('periode', $request->mulai . '-01')->first();
        $selesai = Periode::where('periode', $request->selesai . '-01')->first();

        if (!$mulai) {
            return back()->withErrors(['mulai' => 'Periode mulai tidak tersedia.']);
        }

        if (!$selesai) {
            return back()->withErrors(['selesai' => 'Periode selesai tidak tersedia.']);
        }

        $periodeList = Periode::whereBetween('periode', [$mulai->periode, $selesai->periode])->orderBy('periode', 'asc')->get();

        $stokPerPeriode = [];
        // $historicalData = [];

        foreach ($periodeList as $periode) {

            $stok = Periode_obat::where('id_obat', $obat->id)
                ->where('id_periode', $periode->id)
                ->first();

            $stokPerPeriode[] = [
                'periode' => $periode->periode,
                'jumlah' => $stok ? $stok->jumlah : 0,
            ];
            // $historicalData[] = [
            //     'ds' => Carbon::parse($periode->periode)->format('Y-m-d'), // Tanggal dalam format 'Y-m-d'
            //     'y' => $stok ? $stok->jumlah : 0,
            // ];
        }


        // manual perhitungan
        $trendParams = $this->calculateTrend($stokPerPeriode);
        $seasonal = $this->calculateSeasonal($stokPerPeriode, $trendParams);
        $Prediction = $this->predictStock($trendParams, $seasonal, count($stokPerPeriode) + 1);

        return view('admin.hasil', [
            'trend' => $trendParams, // Data trend
            'seasonal' => $seasonal, // Data musiman
            'prediction' => $Prediction, // Prediksi stok bulan berikutnya
        ]);

        // return response()->json([
        //     'trend' => $trendParams,
        //     'seasonal' => $seasonal,
        //     'prediction' => $Prediction,
        // ]);



        // cara 1

        // Prediksi stok bulan depan
        // if (count($stokPerPeriode) > 1) {
        //     $totalGrowth = 0;

        //     for ($i = 1; $i < count($stokPerPeriode); $i++) {
        //         // Hitung perubahan stok antar bulan
        //         $growth = $stokPerPeriode[$i]['jumlah'] - $stokPerPeriode[$i - 1]['jumlah'];
        //         $totalGrowth += $growth;
        //     }

        //     // Rata-rata kenaikan stok
        //     $averageGrowth = $totalGrowth / (count($stokPerPeriode) - 1);

        //     // Prediksi stok bulan depan
        //     $lastPeriode = end($stokPerPeriode);
        //     $nextMonth = Carbon::parse($lastPeriode['periode'])->addMonth()->format('Y-m-d');
        //     $predictedStock = max(0, $lastPeriode['jumlah'] + $averageGrowth); // Hindari stok negatif

        //     // Tambahkan prediksi ke array
        //     $stokPerPeriode[] = [
        //         'periode' => $nextMonth,
        //         'jumlah' => round($predictedStock), // Pembulatan ke 2 desimal
        //     ];
        // }

        // dd($stokPerPeriode);



        // cara 2
        // $forecastData = $this->predictStok($historicalData);

        // return response()->json([
        //     'forecast' => $forecastData
        // ]);
    }

    private function calculateTrend(array $stokPerPeriode)
    {
        $n = count($stokPerPeriode);
        $sumT = 0;
        $sumY = 0;
        $sumT2 = 0;
        $sumTY = 0;

        foreach ($stokPerPeriode as $index => $data) {
            $t = $index + 1;
            $y = $data['jumlah'];

            $sumT += $t;
            $sumY += $y;
            $sumT2 += $t * $t;
            $sumTY += $t * $y;
        }

        $m = round(($n * $sumTY - $sumT * $sumY) / ($n * $sumT2 - $sumT ** 2), 2);
        // $b = round(($sumY - $m * $sumT) / $n, 2);
        $b = round(($stokPerPeriode[0]['jumlah'] - $m * 1), 2);

        return ['m' => $m, 'b' => $b];
    }

    private function calculateGt($trendParams, $t)
    {
        return round($trendParams['m'] * $t + $trendParams['b'], 2);
    }

    private function calculateSeasonal($dataset, $trendParams)
    {
        $seasonal = [];
        foreach ($dataset as $index => $data) {
            $t = $index + 1;
            $y = $data['jumlah'];
            $g_t = $this->calculateGt($trendParams, $t);
            // error_log("g(t) for t = $t: $g_t");
            $seasonal[] = round($y - $g_t, 2);
        }
        return $seasonal;
    }

    private function predictStock($trendParams, $seasonal, $t)
    {
        $g_t = $this->calculateGt($trendParams, $t);
        // $seasonalAvg = round(array_sum($seasonal) / count($seasonal), 2);
        $seasonalAvg = max($seasonal);
        // dd($seasonalAvg);
        return round($g_t + $seasonalAvg, 2);
    }




    // private function predictStok(array $historicalData)
    // {
    //     // Misalnya, implementasikan regresi sederhana atau moving average di sini
    //     // Contoh sederhana, prediksi menggunakan rata-rata per bulan

    //     $predictedData = [];
    //     $totalStok = 0;
    //     $totalPeriods = count($historicalData);

    //     // Hitung total stok untuk menghitung rata-rata
    //     foreach ($historicalData as $data) {
    //         $totalStok += $data['y'];
    //     }

    //     // Prediksi rata-rata stok untuk periode selanjutnya
    //     $averageStok = $totalStok / $totalPeriods;

    //     // Tambahkan prediksi stok untuk beberapa bulan ke depan
    //     for ($i = 0; $i < 3; $i++) { // Misalnya, prediksi untuk 3 periode berikutnya
    //         $nextPeriod = Carbon::parse($historicalData[$totalPeriods - 1]['ds'])->addMonth($i + 1)->format('Y-m-d');
    //         $predictedData[] = [
    //             'ds' => $nextPeriod,
    //             'y' => $averageStok, // Prediksi stok rata-rata
    //         ];
    //     }

    //     return $predictedData;
    // }
}
