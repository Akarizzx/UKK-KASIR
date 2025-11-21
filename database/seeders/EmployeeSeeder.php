<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Ari Wijaya',
                'email' => 'ari.wijaya@example.com',
                'phone' => '081234567890',
                'position' => 'Store Manager',
                'salary' => 5000000,
                'hire_date' => '2024-01-15',
                'address' => 'Jl. Raya Utama No. 123, Jakarta',
                'status' => 'active',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@example.com',
                'phone' => '082345678901',
                'position' => 'Senior Cashier',
                'salary' => 3500000,
                'hire_date' => '2024-02-20',
                'address' => 'Jl. Merdeka No. 456, Jakarta',
                'status' => 'active',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'phone' => '083456789012',
                'position' => 'Cashier',
                'salary' => 2500000,
                'hire_date' => '2024-03-10',
                'address' => 'Jl. Sudirman No. 789, Jakarta',
                'status' => 'active',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@example.com',
                'phone' => '084567890123',
                'position' => 'Inventory Staff',
                'salary' => 2000000,
                'hire_date' => '2024-04-05',
                'address' => 'Jl. Ahmad Yani No. 321, Jakarta',
                'status' => 'active',
            ],
            [
                'name' => 'Rendra Kusuma',
                'email' => 'rendra.kusuma@example.com',
                'phone' => '085678901234',
                'position' => 'Cashier',
                'salary' => 2500000,
                'hire_date' => '2024-05-18',
                'address' => 'Jl. Gatot Subroto No. 654, Jakarta',
                'status' => 'active',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
