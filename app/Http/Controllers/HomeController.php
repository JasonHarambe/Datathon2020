<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function home()
    {

        $sum = DB::table('trades')
        ->select('year', DB::raw('SUM(import) as import'), DB::raw('SUM(export) as export'))
        ->groupBy('year')
        ->get();

        $counts = DB::table('trades')
        ->select('country', DB::raw('count(*) as total'))
        ->groupBy('country')
        ->get();

        $ten = DB::table('trades')
        ->select('country', DB::raw('ROUND(SUM(export) / 1000000, 1) as export'))
        ->groupBy('country')
        ->orderBy('export', 'DESC')
        ->take(10)
        ->get();

        $eleven = DB::table('trades')
        ->select('country', DB::raw('ROUND(SUM(import) / 1000000, 1) as import'))
        ->groupBy('country')
        ->orderBy('import', 'DESC')
        ->take(10)
        ->get();

        $countries = $counts->pluck('TOTAL', 'country')->toArray();

        $overall = $sum->map(function($sum) {
            return array(
                'year' => $sum->year,
                'import' => number_format($sum->import / 1000000),
                'export' => number_format($sum->export / 1000000),
            );
        });

        $years = $overall->pluck('year');
        $imports = $sum->pluck('import');
        $exports = $sum->pluck('export');

        return view('layouts.partials.home', compact('years', 'imports', 'exports', 'countries', 'overall', 'ten', 'eleven'));
    }

    public function first($id)
    {
        $trades = DB::table('trades')
        ->where('COUNTRY', '=', $id)
        ->join('one', 'trades.SITC1', '=', 'one.DIGIT')
        ->select('DESC', DB::raw('count(*) as TOTAL'), DB::raw('ROUND(SUM(IMPORT), 1) as IMPORT'), DB::raw('ROUND(SUM(EXPORT), 1) as EXPORT'))
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
        ->select('DESC', DB::raw('count(*) as TOTAL'), DB::raw('ROUND(SUM(IMPORT), 1) as IMPORT'), DB::raw('ROUND(SUM(EXPORT), 1) as EXPORT'))
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
        ->select('DESC', DB::raw('count(*) as TOTAL'), DB::raw('ROUND(SUM(IMPORT), 1) as IMPORT'), DB::raw('ROUND(SUM(EXPORT), 1) as EXPORT'))
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
        ->select('DESC', DB::raw('count(*) as TOTAL'), DB::raw('ROUND(SUM(IMPORT), 1) as IMPORT'), DB::raw('ROUND(SUM(EXPORT), 1) as EXPORT'))
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
        ->select('DESC', DB::raw('count(*) as TOTAL'), DB::raw('ROUND(SUM(IMPORT), 1) as IMPORT'), DB::raw('ROUND(SUM(EXPORT), 1) as EXPORT'))
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
