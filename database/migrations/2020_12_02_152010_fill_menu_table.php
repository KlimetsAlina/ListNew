<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FillMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('menu')->insert([
            ['name' => 'Home', 'link' => '/'],
            ['name' => 'Фильмы', 'link' => 'film'],
            ['name' => 'Сериалы', 'link' => 'serial'],
            ['name' => 'Книги', 'link' => 'book'],
            ['name' => 'Музыка', 'link' => 'music'],
            ['name' => 'Другое', 'link' => 'other'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('menu')->truncate();
    }
}
