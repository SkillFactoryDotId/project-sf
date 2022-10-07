<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Attendance;

class AttendanceTableSeeder extends Seeder
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
            'Yuda',
            'Adin',
            'Abin',
        ];
            
        $id_number = [
            '1',
            '2',
            '3',
            '4',
        ];

        foreach (array_combine($list_name, $id_number) as $name => $number)
            {
                Attendance::create([
                    'id_number' => $number,
                    'name' => $name,
                    'total' => 20,
                ]);
            }
        }
            
    }
