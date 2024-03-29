<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrumkitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drumkits', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('about');
            $table->string('image');
            $table->string('drumlink');
            $table->string('sample');
            $table->string('type');
            $table->double('price', 5,2);
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
        Schema::dropIfExists('drumkits');
    }
}
