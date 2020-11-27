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
            ['name' => 'Leon', 'author' => '', 'type' => 'film'],
            ['name' => 'Игрок', 'author' => 'Федор Достоевский', 'type' => 'book'],
            ['name' => 'Записки из мертвого дома', 'author' => 'Федор Достоевский', 'type' => 'book'],
            ['name' => 'POWER UP', 'author' => 'AC/DC', 'type' => 'music'],
            ['name' => 'amo', 'author' => 'Bring Me The Horizon
', 'type' => 'music'],
            ['name' => 'Очень странные дела', 'author' => '', 'type' => 'serial'],
            ['name' => 'Бесы', 'author' => '', 'type' => 'serial'],
            ['name' => 'Конь Бо-Джек', 'author' => '', 'type' => 'serial'],
            ['name' => 'Как ухаживать за цветком', 'author' => '', 'type' => 'other'],
        ]);
    }
}
