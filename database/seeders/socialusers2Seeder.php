<?php

namespace Database\Seeders;
use \App\User;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;
class socialusers2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<=1000;$i++){
            DB::table('socialusers')->insert([
            'username' => Str::random(5),
            'email' => Str::random(5).'@gmail.com',
             'phone' => Str::random(5),
			 'socialid' => Str::random(5),
			 'is_active' => Str::random(5),
			 'is_active' => 'Gmail'
        ]);
		}
    }
}
