<?php

use Illuminate\Database\Seeder;

class postsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 20; $i++) {

            DB::table('posts')->insert(
                [
                    'title' => 'title_' . $i,
                    'title_link' => 'title_link_' . $i,
                    'content_post' => 'this is content ' . $i,
                    'image' => 'a' . $i . '.jpg',
                    'created_at' => new DateTime(),
                ]
            );
        }
//        DB::table('posts')->truncate();
    }
}
