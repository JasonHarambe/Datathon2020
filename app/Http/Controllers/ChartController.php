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
}
