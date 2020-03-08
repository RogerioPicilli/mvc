<?php

use Illuminate\Database\Seeder;
use LaraDev\Post;

class PortsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 10)->create();
    }
}
