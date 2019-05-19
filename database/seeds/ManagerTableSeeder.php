<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('managers')->insert([
        	[
	        	'id' => 1,
	            'name' => 'root',
	            'email' => 'root@gmail.com',
	            'phone' => '0909123456',
	            'password' => bcrypt('123456!'),
	            'avatar' => env('APP_URL') . '/images/avatar/root.jpg',
	            'address' => '308 Điện Biên Phủ, Quận 3',
	            'status' => 'active',
	            'skype' => 'longuyvinh'
            ],
            [
	            'id' => 2,
	            'name' => 'admintest',
	            'email' => 'admintest@gmail.com',
	            'phone' => '0909123457',
	            'password' => bcrypt('123456!'),
	            'avatar' => env('APP_URL') . '/images/avatar/root.jpg',
	            'address' => '72 Lê Thánh Tôn, Quận 1',
	            'status' => 'active',
	            'skype' => 'longuyvinh'
            ]
        ]);
    }
}
