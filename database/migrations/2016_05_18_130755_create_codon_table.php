<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codon', function (Blueprint $table) {
          $table->increments('id');
          $table->string('triplet');
          $table->float('frequency');
          $table->integer('number');
          $table->string('type');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('codon', function (Blueprint $table) {
            Schema::drop('codon');
        });
    }
}
