<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Todo::query()
            ->create([
                'titile' => 'Title One',
                'content' => 'Content One',
                'due' => 'Mondays',
            ]);

        Todo::query()
            ->create([
                'titile' => 'Title Two',
                'content' => 'Content Two',
                'due' => 'Tuesdays',
            ]);
    }
}
