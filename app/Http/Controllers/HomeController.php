<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $results = DB::table('trades')
        ->select('COUNTRY')
        ->distinct()
        ->pluck('COUNTRY');

        $sum = DB::table('trades')
        ->select('YEAR', DB::raw('SUM(IMPORT) as IMPORT'), DB::raw('SUM(EXPORT) as EXPORT'))
        ->groupBy('YEAR')
        ->get();

        $years = $sum->pluck('YEAR');
        $imports = $sum->pluck('IMPORT');
        $exports = $sum->pluck('EXPORT');

        return view('layouts.partials.home', compact('results', 'years', 'imports', 'exports'));
    }

    public function first($id)
    {
        $trades = DB::table('trades')
        ->where('COUNTRY', '=', $id)
        ->join('one', 'trades.SITC1', '=', 'one.DIGIT')
        ->select('DESC')
        ->distinct()
        ->pluck('DESC');

        return view('layouts.partials.first', compact('trades', 'id'));
    }

    public function second($id, $first)
    {
        $uno = DB::table('one')->where('DESC', '=', $first)->pluck('DIGIT')->first();

        $trades = DB::table('trades')
        ->where('COUNTRY', '=', $id)
        ->where('SITC1', '=', $uno)
        ->join('two', 'trades.SITC2', '=', 'two.DIGIT')
        ->select('DESC')
        ->distinct()
        ->pluck('DESC');

        return view('layouts.partials.second', compact('trades', 'id', 'first'));
    }

    public function third($id, $first, $second)
    {
        $uno = DB::table('one')->where('DESC', '=', $first)->pluck('DIGIT')->first();
        $duo = DB::table('two')->where('DESC', '=', $second)->pluck('DIGIT')->first();

        $trades = DB::table('trades')
        ->where('COUNTRY', '=', $id)
        ->where('SITC1', '=', $uno)
        ->where('SITC2', '=', $duo)
        ->join('three', 'trades.SITC3', '=', 'three.DIGIT')
        ->select('DESC')
        ->distinct()
        ->pluck('DESC');

        return view('layouts.partials.third', compact('trades', 'id', 'first', 'second'));
    }

    public function fourth($id, $first, $second, $third)
    {
        $uno = DB::table('one')->where('DESC', '=', $first)->pluck('DIGIT')->first();
        $duo = DB::table('two')->where('DESC', '=', $second)->pluck('DIGIT')->first();
        $trio = DB::table('three')->where('DESC', '=', $third)->pluck('DIGIT')->first();

        $trades = DB::table('trades')
        ->where('COUNTRY', '=', $id)
        ->where('SITC1', '=', $uno)
        ->where('SITC2', '=', $duo)
        ->where('SITC3', '=', $trio)
        ->join('four', 'trades.SITC4', '=', 'four.DIGIT')
        ->select('DESC')
        ->distinct()
        ->pluck('DESC');

        return view('layouts.partials.fourth', compact('trades', 'id', 'first', 'second', 'third'));
    }

    public function fifth($id, $first, $second, $third, $fourth)
    {
        $uno = DB::table('one')->where('DESC', '=', $first)->pluck('DIGIT')->first();
        $duo = DB::table('two')->where('DESC', '=', $second)->pluck('DIGIT')->first();
        $trio = DB::table('three')->where('DESC', '=', $third)->pluck('DIGIT')->first();
        $quattro = DB::table('four')->where('DESC', '=', $fourth)->pluck('DIGIT')->first();

        $trades = DB::table('trades')
        ->where('COUNTRY', '=', $id)
        ->where('SITC1', '=', $uno)
        ->where('SITC2', '=', $duo)
        ->where('SITC3', '=', $trio)
        ->where('SITC4', '=', $quattro)
        ->join('five', 'trades.SITC5', '=', 'five.DIGIT')
        ->select('DESC')
        ->distinct()
        ->pluck('DESC');

        return view('layouts.partials.fifth', compact('trades', 'id', 'first', 'second', 'third', 'fourth'));
    }

    public function product($id, $first, $second, $third, $fourth, $fifth)
    {
        $uno = DB::table('one')->where('DESC', '=', $first)->pluck('DIGIT')->first();
        $duo = DB::table('two')->where('DESC', '=', $second)->pluck('DIGIT')->first();
        $trio = DB::table('three')->where('DESC', '=', $third)->pluck('DIGIT')->first();
        $quattro = DB::table('four')->where('DESC', '=', $fourth)->pluck('DIGIT')->first();
        $cuattro = DB::table('five')->where('DESC', '=', $fifth)->pluck('DIGIT')->first();

        $trades = DB::table('trades')
        ->where('COUNTRY', '=', $id)
        ->where('SITC1', '=', $uno)
        ->where('SITC2', '=', $duo)
        ->where('SITC3', '=', $trio)
        ->where('SITC4', '=', $quattro)
        ->where('SITC5', '=', $cuattro)
        ->get();

        dd($trades);

        return view('layouts.partials.product', compact('trades', 'id', 'first', 'second', 'third', 'fourth', 'fifth'));
    }

}
