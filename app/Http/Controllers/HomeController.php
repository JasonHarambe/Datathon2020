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

        $countries = $counts->pluck('total', 'country')->toArray();

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

        return view('layouts.home', compact('years', 'imports', 'exports', 'countries', 'overall'));
    }

    public function first($id)
    {
        $trades = DB::table('trades')
        ->where('country', '=', $id)
        ->join('one', 'trades.sitc1', '=', 'one.digit')
        ->select('desc', DB::raw('count(*) as total'), DB::raw('ROUND(SUM(import), 1) as import'), DB::raw('ROUND(SUM(export), 1) as export'))
        ->groupBy('desc')
        ->get();

        $series = DB::table('trades')
        ->where('country', 'like', $id)
        ->select('year', DB::raw('SUM(import) as import '), DB::raw('SUM(export) as export'))
        ->groupBy('year')
        ->get();

        return view('layouts.partials.first', compact('trades', 'id', 'series'));
    }

    public function second($id, $first)
    {
        $uno = DB::table('one')->where('desc', '=', $first)->pluck('digit')->first();

        $trades = DB::table('trades')
        ->where('country', '=', $id)
        ->where('sitc1', '=', $uno)
        ->join('two', 'trades.sitc2', '=', 'two.digit')
        ->select('desc', DB::raw('count(*) as total'), DB::raw('ROUND(SUM(import), 1) as import'), DB::raw('ROUND(SUM(export), 1) as export'))
        ->groupBy('desc')
        ->get();

        return view('layouts.partials.second', compact('trades', 'id', 'first'));
    }

    public function third($id, $first, $second)
    {
        $uno = DB::table('one')->where('desc', '=', $first)->pluck('digit')->first();
        $duo = DB::table('two')->where('desc', 'like', '%'.$second.'%')->pluck('digit')->first();

        $trades = DB::table('trades')
        ->where('country', '=', $id)
        ->where('sitc1', '=', $uno)
        ->where('sitc2', '=', $duo)
        ->join('three', 'trades.sitc3', '=', 'three.digit')
        ->select('desc', DB::raw('count(*) as total'), DB::raw('ROUND(SUM(import), 1) as import'), DB::raw('ROUND(SUM(export), 1) as export'))
        ->groupBy('desc')
        ->get();

        return view('layouts.partials.third', compact('trades', 'id', 'first', 'second'));
    }

    public function fourth($id, $first, $second, $third)
    {
        $uno = DB::table('one')->where('desc', '=', $first)->pluck('digit')->first();
        $duo = DB::table('two')->where('desc', 'like', '%'.$second.'%')->pluck('digit')->first();
        $trio = DB::table('three')->where('desc', 'like', '%'.$third.'%')->pluck('digit')->first();

        $trades = DB::table('trades')
        ->where('country', '=', $id)
        ->where('sitc1', '=', $uno)
        ->where('sitc2', '=', $duo)
        ->where('sitc3', '=', $trio)
        ->join('four', 'trades.sitc4', '=', 'four.digit')
        ->select('desc', DB::raw('count(*) as total'), DB::raw('ROUND(SUM(import), 1) as import'), DB::raw('ROUND(SUM(export), 1) as export'))
        ->groupBy('desc')
        ->get();

        return view('layouts.partials.fourth', compact('trades', 'id', 'first', 'second', 'third'));
    }

    public function fifth($id, $first, $second, $third, $fourth)
    {
        $uno = DB::table('one')->where('desc', '=', $first)->pluck('digit')->first();
        $duo = DB::table('two')->where('desc', 'like', '%'.$second.'%')->pluck('digit')->first();
        $trio = DB::table('three')->where('desc', 'like', '%'.$third.'%')->pluck('digit')->first();
        $quattro = DB::table('four')->where('desc', 'like', '%'.$fourth.'%')->pluck('digit')->first();

        $trades = DB::table('trades')
        ->where('country', '=', $id)
        ->where('sitc1', '=', $uno)
        ->where('sitc2', '=', $duo)
        ->where('sitc3', '=', $trio)
        ->where('sitc4', '=', $quattro)
        ->join('five', 'trades.sitc5', '=', 'five.digit')
        ->select('desc', DB::raw('count(*) as total'), DB::raw('ROUND(SUM(import), 1) as import'), DB::raw('ROUND(SUM(export), 1) as export'))
        ->groupBy('desc')
        ->get();

        return view('layouts.partials.fifth', compact('trades', 'id', 'first', 'second', 'third', 'fourth'));
    }

    public function product($id, $first, $second, $third, $fourth, $fifth)
    {
        $uno = DB::table('one')->where('desc', '=', $first)->pluck('digit')->first();
        $duo = DB::table('two')->where('desc', 'like', '%'.$second.'%')->pluck('digit')->first();
        $trio = DB::table('three')->where('desc', 'like', '%'.$third.'%')->pluck('digit')->first();
        $quattro = DB::table('four')->where('desc', 'like', '%'.$fourth.'%')->pluck('digit')->first();
        $cuattro = DB::table('five')->where('desc', 'like', '%'.$fifth.'%')->pluck('digit')->first();

        $trades = DB::table('trades')
        ->where('country', '=', $id)
        ->where('sitc1', '=', $uno)
        ->where('sitc2', '=', $duo)
        ->where('sitc3', '=', $trio)
        ->where('sitc4', '=', $quattro)
        ->where('sitc5', '=', $cuattro)
        ->get();

        $years = $trades->pluck('year');
        $imports = $trades->pluck('import');
        $exports = $trades->pluck('export');
        
        $trades->all();

        return view('layouts.partials.product', compact('trades', 'id', 'first', 'second', 'third', 'fourth', 'fifth', 'years', 'imports', 'exports'));
    }

}
