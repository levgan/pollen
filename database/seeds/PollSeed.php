<?php

use Illuminate\Database\Seeder;

class PollSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Sterling Team Standards', 'description' => null,],

        ];

        foreach ($items as $item) {
            \App\Poll::create($item);
        }
    }
}
