<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function home()
    {

        $sum = DB::table('trades')
        ->select('YEAR', DB::raw('SUM(IMPORT) as IMPORT'), DB::raw('SUM(EXPORT) as EXPORT'))
        ->groupBy('YEAR')
        ->get();

        $counts = DB::table('trades')
        ->select('COUNTRY', DB::raw('count(*) as TOTAL'))
        ->groupBy('COUNTRY')
        ->get();

        $countries = $counts->pluck('TOTAL', 'COUNTRY')->toArray();

        $overall = $sum->map(function($sum) {
            return array(
                'YEAR' => $sum->YEAR,
                'IMPORT' => number_format($sum->IMPORT / 1000000),
                'EXPORT' => number_format($sum->EXPORT / 1000000),
            );
        });

        $years = $overall->pluck('YEAR');
        $imports = $sum->pluck('IMPORT');
        $exports = $sum->pluck('EXPORT');

        return view('layouts.partials.home', compact('years', 'imports', 'exports', 'countries', 'overall'));
    }

    public function first($id)
    {
        $trades = DB::table('trades')
        ->where('COUNTRY', '=', $id)
        ->join('one', 'trades.SITC1', '=', 'one.DIGIT')
        ->select('DESC', DB::raw('count(*) as TOTAL'))
        ->groupBy('DESC')
        ->get();

        return view('layouts.partials.first', compact('trades', 'id'));
    }

    public function second($id, $first)
    {
        $uno = DB::table('one')->where('DESC', '=', $first)->pluck('DIGIT')->first();

        $trades = DB::table('trades')
        ->where('COUNTRY', '=', $id)
        ->where('SITC1', '=', $uno)
        ->join('two', 'trades.SITC2', '=', 'two.DIGIT')
        ->select('DESC', DB::raw('count(*) as TOTAL'))
        ->groupBy('DESC')
        ->get();

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
        ->select('DESC', DB::raw('count(*) as TOTAL'))
        ->groupBy('DESC')
        ->get();

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
        ->select('DESC', DB::raw('count(*) as TOTAL'))
        ->groupBy('DESC')
        ->get();

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
        ->select('DESC', DB::raw('count(*) as TOTAL'))
        ->groupBy('DESC')
        ->get();

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

        $years = $trades->pluck('YEAR');
        $imports = $trades->pluck('IMPORT');
        $exports = $trades->pluck('EXPORT');
        
        $trades->all();

        return view('layouts.partials.product', compact('trades', 'id', 'first', 'second', 'third', 'fourth', 'fifth', 'years', 'imports', 'exports'));
    }

}
