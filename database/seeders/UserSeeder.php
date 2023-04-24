<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $create_date=date('Y-m-d H:i:s');
     
       //create admin
        $admin = User::create([

            'name' => 'admin',
            'email' => 'admin@babcock.com',
            'phone' => '08178654532',
            'password' => Hash::make('password'),
            'email_verified_at'=>$create_date
       ]);

       //assign admin role to user
       $admin->assignRole('admin');


       //create breeder
       $breeder = User::create([

        'name' => 'breeder',
        'email' => 'breeder@babcock.com',
        'phone' => '08123456784',
        'password' => Hash::make('password'),
        'email_verified_at'=>$create_date
   ]);

   //assign breeder role to user
   $breeder->assignRole('breeder');

   //create client
   $client = User::create([

    'name' => 'client',
    'email' => 'client@babcock.com',
    'phone' => '08197879835',
    'password' => Hash::make('password'),
    'email_verified_at'=>$create_date
]);

//assign client role to user
$client->assignRole('client');

  
}

}
