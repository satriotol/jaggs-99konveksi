<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','satriotol69@gmail.com')->first();
        if (!$user) {
            User::create([
                'name' => 'Satrio Jati Wicaksono',
                'phone_number' => '089620755330',
                'email' => 'satriotol69@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('pandeanlamper69b'),
            ]);
        }
    }
}
