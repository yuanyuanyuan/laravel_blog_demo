<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('link')->insert([
            'link_name' => str_random(10),
            'link_title' => str_random(10),
            'link_url' => 'http://www.baidu.com',
            'link_order' => random_int(1,100),
        ]);

    }
}
