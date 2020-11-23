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

        return view('layouts.partials.interactive', compact('countries'));
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
}
