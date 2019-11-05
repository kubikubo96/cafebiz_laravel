<?php

use Illuminate\Database\Seeder;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i <= 10;$i++)
        {
            DB::table('Users')->insert(
                [
                    'name' => 'User_'.$i,
                    'email' => 'user'.$i.'@gmail.com',
                    'password' => bcrypt('1'),
                    'admin' => 0,
                    'created_at' => new DateTime(),
                ]
            );
        }
        DB::table('Users')->insert(
            [
                'name' => 'Nguyễn Tất Tiến',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('1'),
                'admin' => 1,
                'created_at' => new DateTime(),
            ]
        );
    }
}
