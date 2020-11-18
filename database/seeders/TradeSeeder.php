<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('trades')->insert([
        //     'YEAR' => Carbon::now()->subYears(rand(5, 10))->format('Y'),
        //     'SITC1' => rand(0, 7),
        //     'SITC2' => '0' + rand(0, 7),
        //     'SITC3' => Str::random(10),
        //     'SITC4' => Str::random(10),
        //     'SITC5' => Str::random(10),
        //     'COUNTRY' => Str::random(10),
        //     'IMPORT' => 10,
        //     'EXPORT' => 10,
        // ]);
    }
}
