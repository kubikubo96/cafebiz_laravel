<?php

use Illuminate\Database\Seeder;

class commentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('comments')->insert([
            [
                'idUser' => '1',
                'idPost' => '2',
                'content_comment' =>'comments 1',
                'created_at' => new DateTime(),
            ],
            [
                'idUser' => '2',
                'idPost' => '1',
                'content_comment' =>'comments 2',
                'created_at' => new DateTime(),
            ],
            [
                'idUser' => '1',
                'idPost' => '3',
                'content_comment' =>'comments 3',
                'created_at' => new DateTime(),
            ],
            [
                'idUser' => '3',
                'idPost' => '1',
                'content_comment' =>'comments 4',
                'created_at' => new DateTime(),
            ],
            [
                'idUser' => '1',
                'idPost' => '4',
                'content_comment' =>'comments 5',
                'created_at' => new DateTime(),
            ],
            [
                'idUser' => '4',
                'idPost' => '1',
                'content_comment' =>'comments 6',
                'created_at' => new DateTime(),
            ],
            [
                'idUser' => '1',
                'idPost' => '5',
                'content_comment' =>'comments 7',
                'created_at' => new DateTime(),
            ],
            [
                'idUser' => '5',
                'idPost' => '1',
                'content_comment' =>'comments 8',
                'created_at' => new DateTime(),
            ],
            [
                'idUser' => '1',
                'idPost' => '6',
                'content_comment' =>'comments 9',
                'created_at' => new DateTime(),
            ],
            [
                'idUser' => '6',
                'idPost' => '1',
                'content_comment' =>'comments 10',
                'created_at' => new DateTime(),
            ],
        ]);
//        DB::table('comments')->truncate();
    }
}
