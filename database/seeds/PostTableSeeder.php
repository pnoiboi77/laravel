<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new \App\Post([
            'title' => 'Seeding first title',
            'content' => 'Seeding the first title',
        ]);
        $post ->save();

        $post = new \App\Post([
            'title' => 'Seeding second title',
            'content' => 'Seeding the second title',
        ]);
        $post ->save();
    }
}
