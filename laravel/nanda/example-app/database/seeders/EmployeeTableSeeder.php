<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_employee = [
            [
                'id_number' => 1,
                'name' => 'Bejo',
                'address' => 'Jakarta Selatan',
                'age' => '17',
                'position' => 'Manager',

            ],

            [
                'id_number' => 2,
                'name' => 'Joko',
                'address' => 'Sumatra utara',
                'age' => '16',
                'position' => 'Admin manager',
            ],

            [
                'id_number' => 3,
                'name' => 'Joko',
                'address' => 'Sumatra selatan',
                'age' => '16',
                'position' => 'Seketaris',
            ],

            [
                'id_number' => 4,
                'name' => 'Bani',
                'address' => 'Jakarta utara',
                'age' => '16',
                'position' => 'Super admin',
            ]
        ];

        foreach ($list_employee as $employee) {
            Employee::create([
                'id_number' => $employee['id_number'],
                'name' => $employee['name'],
                'address' => $employee['address'],
                'age' => $employee['age'],
                'position' => $employee['position'],
            ]);
        }
    }
};