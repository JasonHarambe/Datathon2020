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
            $table->year('YEAR');
            $table->string('SITC1');
            $table->string('SITC2');
            $table->string('SITC3');
            $table->string('SITC4');
            $table->string('SITC5');
            $table->string('COUNTRY');
            $table->integer('IMPORT');
            $table->integer('EXPORT');
            $table->index(['COUNTRY']);
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
