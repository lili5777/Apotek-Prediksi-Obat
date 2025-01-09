<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dahboard');
    }

    public function dataobat()
    {
        return view('admin.dataobat');
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
