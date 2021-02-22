<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beats', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover');
            $table->string('sample');
            $table->string('bpmkey');
            $table->string('basic');
            $table->string('premium');
            $table->string('unlimited');
            $table->string('tags');
            $table->boolean('ispaid')->default(true);
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
        Schema::dropIfExists('beats');
    }
}
