<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employe;

class EmployeSeeder extends Seeder
{
    /**

     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,20) as $index) {
            Employe::create([
                'first_name' => "First{$index}",
                'last_name' => "Last {$index}",       
                'email' => "email{$index}@demo.com",
                'phone' => "999999999{$index}",
                'company_id' =>  "{$index}"
            ]);
        }
    }
}