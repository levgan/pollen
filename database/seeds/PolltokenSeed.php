<?php

use Illuminate\Database\Seeder;

class PolltokenSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Sterling Team Standards', 'description' => null, 'user_id' => null, 'token' => 'abFvQfgster', 'poll_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\Polltoken::create($item);
        }
    }
}
