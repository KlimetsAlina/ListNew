<?php

use Illuminate\Database\Seeder;

class ContentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('content')->insert([
            ['name' => 'Leon', 'author' => '', 'type' => 'film', 'something' => '{}'],
            ['name' => 'Игрок', 'author' => 'Федор Достоевский', 'type' => 'book', 'something' => '{}'],
            ['name' => 'Записки из мертвого дома', 'author' => 'Федор Достоевский', 'type' => 'book', 'something' => '{}'],
            ['name' => 'POWER UP', 'author' => 'AC/DC', 'type' => 'music', 'something' => '{}'],
            ['name' => 'amo', 'author' => 'Bring Me The Horizon', 'type' => 'music', 'something' => '{}'],
            ['name' => 'Очень странные дела', 'author' => '', 'type' => 'serial', 'something' => '{}'],
            ['name' => 'Бесы', 'author' => '', 'type' => 'serial', 'something' => '{}'],
            ['name' => 'Конь Бо-Джек', 'author' => '', 'type' => 'serial', 'something' => '{}'],
            ['name' => 'Как ухаживать за цветком', 'author' => '', 'type' => 'other', 'something' => '{}'],
        ]);
    }
}
