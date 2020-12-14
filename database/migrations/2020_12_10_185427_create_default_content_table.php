<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_content', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('imgLink');
            $table->string('cssClass');
        });

        DB::table('default_content')->insert([
            ['name' => 'Фильмы', 'type' => 'film', 'imgLink' => '', 'cssClass' => 'defImg'],
            ['name' => 'Сериалы', 'type' => 'serial', 'imgLink' => '', 'cssClass' => 'defImg'],
            ['name' => 'Книги', 'type' => 'book', 'imgLink' => '', 'cssClass' => 'defImg'],
            ['name' => 'Музыка', 'type' => 'music', 'imgLink' => '', 'cssClass' => 'defImg'],
            ['name' => 'Другое', 'type' => 'other', 'imgLink' => '', 'cssClass' => 'defImg'],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('default_content');
    }
}
