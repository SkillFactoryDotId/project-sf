<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_name = [
            'Nanda',
            'Syah',
            'Putra',
            'Putri',
            'Syahira',
            'Dewi'
        ];

        foreach ($list_name as $name) {
            User::create([
                'name' => $name,
                'email' => strtolower($name).'@gmail.com',
                'password' => Hash::make('password'),
            ]);
        } 
    }
}
