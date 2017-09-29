<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 通过调用 seed class 来进行插入数据
         $this->call(LinksTableSeeder::class);
    }
}
