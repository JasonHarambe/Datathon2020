<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MalaysiaImportExport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function(Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->string('sitc1');
            $table->string('sitc2');
            $table->string('sitc3');
            $table->string('sitc4');
            $table->string('sitc5');
            $table->string('country');
            $table->bigInteger('import');
            $table->bigInteger('export');
            $table->index(['country']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
