<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRegistros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $connection = 'mongodb';
    public function up()
    {
        Schema::create('table_registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label', 200)->nullable(false);
            $table->string('numero', 200)->nullable(false);
            $table->boolean('blacklist');
            $table->unique('numero');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_registros');
    }
}
