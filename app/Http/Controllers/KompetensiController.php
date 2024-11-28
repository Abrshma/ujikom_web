<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    public function pplg()
    {
        return view('kompetensi.pplg');
    }

    public function tjkt()
    {
        return view('kompetensi.tjkt');
    }

    public function tkr()
    {
        return view('kompetensi.tkr');
    }

    public function tflm()
    {
        return view('kompetensi.tflm');
    }
}