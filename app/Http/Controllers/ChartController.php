<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function interactive()
    {
        $countries = DB::table('trades')
        ->select('country')
        ->distinct()
        ->get();

        return view('layouts.interactive', compact('countries'));
    }


    public function getChartData($country) 
    {
        $data = DB::table('trades')
        ->where('country', '=', $country)
        ->select('country', 'year', DB::raw('SUM(import) as import'), DB::raw('SUM(export) as export'))
        ->groupBy('country', 'year')
        ->get();

        return $data;
    }

    public function getTopTenByExports()
    {
        $data = DB::table('trades')
        ->select('country', DB::raw('ROUND(SUM(export) / 1000000, 1) as export'))
        ->groupBy('country')
        ->orderBy('export', 'DESC')
        ->take(10)
        ->get();

        return $data;
    }

    public function getTopTenByImports()
    {
        $data = DB::table('trades')
        ->select('country', DB::raw('ROUND(SUM(import) / 1000000, 1) as import'))
        ->groupBy('country')
        ->orderBy('import', 'DESC')
        ->take(10)
        ->get();

        return $data;
    }

    public function infographic()
    {
        $countries = DB::table('trades')->select('country')->distinct()->get();

        return view('layouts.infographic', compact('countries'));
    }

    public function groupByCategory($country)
    {
        $data = DB::table('trades')
        ->join('one', 'trades.sitc1', '=', 'one.digit')
        ->select('desc', DB::raw('SUM(import) as import'), DB::raw('SUM(export) as export'))
        ->where('country', '=', $country)
        ->groupBy('desc')
        ->get();

        return $data;

    }
    
    public function map()
    {

        $sum = DB::table('trades')
        ->select('YEAR', DB::raw('SUM(IMPORT) as IMPORT'), DB::raw('SUM(EXPORT) as EXPORT'))
        ->groupBy('YEAR')
        ->get();

        $counts = DB::table('trades')
        ->select('COUNTRY', DB::raw('count(*) as TOTAL'))
        ->groupBy('COUNTRY')
        ->get();

        $ten = DB::table('trades')
        ->select('COUNTRY', DB::raw('ROUND(SUM(EXPORT) / 1000000, 1) as EXPORT'))
        ->groupBy('COUNTRY')
        ->orderBy('EXPORT', 'DESC')
        ->take(10)
        ->get();

        $eleven = DB::table('trades')
        ->select('COUNTRY', DB::raw('ROUND(SUM(IMPORT) / 1000000, 1) as IMPORT'))
        ->groupBy('COUNTRY')
        ->orderBy('IMPORT', 'DESC')
        ->take(10)
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

        return view('layouts.map', compact('years', 'imports', 'exports', 'countries', 'overall', 'ten', 'eleven'));
}
